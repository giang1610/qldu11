<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



use function Laravel\Prompts\search;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    //     $query = DB::table('products')
    //     ->join('categories', 'products.category_id', '=', 'categories.id')
    //     ->select('products.*', 'categories.name as category_name')
    //     ->orderBy('products.id', 'desc'); // Sắp xếp theo ID giảm dần

    // // Kiểm tra nếu có tìm kiếm
    // if ($request->has('search')) {
    //     $query->where('products.name', 'like', '%' . $request->search . '%');
    // }

    // // Phân trang 5 sản phẩm mỗi trang
    // $products = $query->paginate(5);
    // return view('products.index', compact('products'));


    $query = Product::with('category');
    if($request->has('search')){
        $query->where('name','like','%' . $request->search .'%');
    }

    $products = $query->orderBy('id','desc')->paginate(5);
    return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // $categories = DB::table('categories')
    //                 ->where('status', 1) // Chỉ lấy những danh mục có status = 1
    //                 ->get();

    // return view('products.create', compact('categories'));

    $categories = Category::all();
    return view('admin.products.create', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // Xử lý upload ảnh nếu có
    // if ($request->hasFile('image')) {
    //     $imagePath = $request->file('image')->store('products', 'public'); // Lưu ảnh vào storage/app/public/products
    // } else {
    //     $imagePath = null;
    // }

    // // Thêm dữ liệu vào bảng products
    //     DB::table('products')->insert([
    //         'name'        => $request->name,
    //         'price'       => $request->price,
    //         'quantity'    => $request->quantity,
    //         'image'       => $imagePath, 
    //         'category_id' => $request->category_id,
    //         'description' => $request->description,
    //         'status'      => (bool) $request->status,
           
    //     ]);
    

    
    //     return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');


    $data = $request->validated();
    if($request->hasFile('image')){
        $data['image'] = $request->file('image')->store('products', 'public');
        
    }
  
    Product::create($data);
   

     return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //lấy dữ liệu của bản ghi cần chỉnh sửa
       
        // $product = DB::table('products')
        // ->join('categories', 'products.category_id', '=', 'categories.id')
        // ->select('products.*', 'categories.name as category_name') // Lấy tên danh mục
        // ->where('products.id', $id)
        // ->first();
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //lấy dữ liệu của bản ghi cần chỉnh sửa
       
    //    $product = DB::table('products')->where('id',$id)->first();
    //    $categories = DB::table('categories')->get();
    // //    var_dump($categories);
    //    //trả dữ liệu về view
    //    return view('products.edit', compact('product','categories'));


    $categories = Category::all();

    return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // Kiểm tra xem có file ảnh mới được upload không
        // if ($request->hasFile('image')) {
        //     // Lưu ảnh vào thư mục storage/public/products
        //     $imagePath = $request->file('image')->store('products', 'public');
        // } else {
        //     // Nếu không có ảnh mới, giữ nguyên ảnh cũ
        //     $imagePath = DB::table('products')->where('id', $id)->value('image');
        // }

        // // Cập nhật dữ liệu sản phẩm
        // DB::table('products')->where('id', $id)->update([
        //     'name'        => $request->name,
        //     'price'       => $request->price,
        //     'quantity'    => $request->quantity,
        //     'image'       => $imagePath,
        //     'category_id' => $request->category_id,
        //     'description' => $request->description,
        //     'status'      => (bool) $request->status,
            
        // ]);

        // return redirect()->route('products.index')->with('success','chỉnh sửa thành công');
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // DB::table('products')->where('id',$id)->delete();
        // return redirect()->route('products.index')->with('success','xóa thành công');
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','xóa thành công');
    }
}
