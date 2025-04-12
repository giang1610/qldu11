<?php

namespace App\Http\Controllers;

use App\Models\DatVeDuLich;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\DatVeDuLichRequest;

class DatVeDuLichController extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function store(DatVeDuLichRequest $request, Product $product)
    {
        // Thông tin tài khoản test trong file account_test
        $ten_nguoi_dat = $request->ten_nguoi_dat;
        $email = $request->email;
        $so_luong = $request->so_luong;
        $tong_tien = $product->price * $so_luong;
        $hinh_thuc_thanh_toan = $request->hinh_thuc_thanh_toan;

        if ($hinh_thuc_thanh_toan === 'vi_dien_tu') {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderId = time() . "";
            $requestId = time() . "";
            $orderInfo = "Thanh toán chuyến đi: " . $product->name;
            $redirectUrl = route('momo.return'); // sau khi thanh toán thành công
            $ipnUrl = route('client.listve');
            $extraData = "";
            $requestType = "payWithATM"; // Hình thức thamh toán là ATM, có thể đổi thành qrcode

            $rawHash = "accessKey=$accessKey&amount=$tong_tien&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $tong_tien,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            // dd($jsonResult);
            // Tạo session tạm thời để lưu dữ liệu vào database
            session([
                'booking_data' => [
                    'product_id' => $product->id,
                    'ten_nguoi_dat' => $ten_nguoi_dat,
                    'email' => $email,
                    'so_luong' => $so_luong,
                    'tong_tien' => $tong_tien,
                    'hinh_thuc_thanh_toan' => $hinh_thuc_thanh_toan,
                ]
            ]);

            return redirect($jsonResult['payUrl']);
        }

        DatVeDuLich::create([
            'product_id' => $product->id,
            'ten_nguoi_dat' => $ten_nguoi_dat,
            'email' => $email,
            'so_luong' => $so_luong,
            'tong_tien' => $tong_tien,
            'hinh_thuc_thanh_toan' => $hinh_thuc_thanh_toan,
        ]);

        return redirect()->route('client.list')->with('success', 'Đặt vé thành công!');
    }


    public function index(Request $request)
    {
        $datVeDuLich = DatVeDuLich::all();
        return view('client.listve', compact('datVeDuLich'));
    }
    public function index2(Request $request)
    {
        $datVeDuLich = DatVeDuLich::all();
        return view('admin.tickets.index2', compact('datVeDuLich'));
    }
    public function destroy($id)
    {
        $ve = DatVeDuLich::findOrFail($id);

        if ($ve->trang_thai == 1) {
            return redirect()->back()->with('error', 'Vé đã được xác nhận, không thể hủy.');
        }

        $ve->delete();
        return redirect()->back()->with('success', 'Hủy vé thành công.');
    }
    public function handleMomoReturn(Request $request)
    {
        if ($request->get('resultCode') == 0) {
            $data = session('booking_data');

            if ($data) {
                $product = Product::find($data['product_id']);

                // Lưu vào database
                DatVeDuLich::create([
                    'product_id' => $data['product_id'],
                    'ten_nguoi_dat' => $data['ten_nguoi_dat'],
                    'email' => $data['email'],
                    'so_luong' => $data['so_luong'],
                    'tong_tien' => $data['tong_tien'],
                    'hinh_thuc_thanh_toan' => $data['hinh_thuc_thanh_toan'],
                ]);
                // Xóa session tạm
                session()->forget('booking_data');

                return redirect()->route('client.list')->with('success', 'Đặt vé và thanh toán thành công!');
            } else {
                return redirect()->route('client.list')->with('error', 'Không tìm thấy thông tin đặt vé');
            }

        } else {
            return redirect()->route('client.list')->with('error', 'Thanh toán thất bại hoặc bị hủy!');
        }
    }
}