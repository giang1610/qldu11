<?php

namespace App\Http\Controllers;

use App\Models\DatVeDuLich;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\DatVeDuLichRequest;

class DatVeDuLichController extends Controller
{
    public function store(DatVeDuLichRequest $request, Product $product)
    {
        DatVeDuLich::create([
            'product_id' => $product->id,
            'ten_nguoi_dat' => $request->ten_nguoi_dat,
            'email' => $request->email,
            'so_luong' => $request->so_luong,
            'tong_tien' => $product->price * $request->so_luong,
            'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
            'trang_thai' => 0
        ]);

        return redirect()->route('list', $product->id)->with('success', 'Đặt vé thành công!');

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
}