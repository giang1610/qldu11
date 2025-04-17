<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\DatVeDuLich;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Bắt đầu truy vấn với sản phẩm có trạng thái 1 (Hoạt động)
        $query = Product::with('category')->where('status', 1);

        // Nếu có từ khóa tìm kiếm, thêm điều kiện tìm kiếm vào truy vấn
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Lọc theo mệnh giá
        if ($request->has('price_range')) {
            switch ($request->price_range) {
                case 'under_500':
                    $query->where('price', '<', 500);
                    break;
                case '500_1000':
                    $query->whereBetween('price', [500, 1000]);
                    break;
                case 'over_1000':
                    $query->where('price', '>', 1000);
                    break;
            }
        }

        // Thực hiện truy vấn và lấy các sản phẩm đã lọc
        $products = $query->orderBy('id', 'DESC')->get();

        // Lấy tất cả danh mục có trạng thái 1 (Hoạt động)
        $categories = Category::where('status', 'active')->orderBy('id', 'DESC')->get();


        return view('client.list', compact('categories', 'products'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(DatVeDuLich $dat_ve_du_lich)
    // {
    //     DatVeDuLich::create([
    //         'product_id' => $product->id,
    //         'ten_nguoi_dat' => $request->ten_nguoi_dat,
    //         'email' => $request->email,
    //         'so_luong' => $request->so_luong,
    //         'tong_tien' => $product->price * $request->so_luong,
    //         'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
    //         'trang_thai' => 0 // Mặc định
    //     ]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $category = $product->category;
        // Lấy 5 sản phẩm cùng danh mục và có trạng thái "hoạt động"
        $top5Products = $category->products()
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->limit(5)
            ->get();

        return view('client.show', compact('product', 'category', 'top5Products'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function form(Product $product)
    {


        return view('client.dat', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
