<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\search;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('categories')->orderBy('id','desc');

        if($request->has('search')){
            $query->where('name','like','%' . $request->search .'%');
        }

        $categories = $query->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        DB::table('categories')->insert([
            'name'=>$request->name,
            'status'=>(bool) $request->status,
        ]);
        return redirect()->route('categories.index')->with('success','thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = DB::table('categories')->where('id',$id)->first();
       //trả dữ liệu về view
       return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //lấy dữ liệu của bản ghi cần chỉnh sửa
       $category = DB::table('categories')->where('id',$id)->first();
       //trả dữ liệu về view
       return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        DB::table('categories')->where('id',$id)->update([
            'name'=>$request->name,
             'status'=>(bool) $request->status
        ]);
        return redirect()->route('categories.index')->with('success','chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Kiểm tra xem danh mục có sản phẩm nào không
    $productCount = DB::table('products')->where('category_id', $id)->count();

    if ($productCount > 0) {
        // Nếu có sản phẩm, không cho phép xóa và hiển thị thông báo
        return redirect()->route('categories.index')->with('error', 'Danh mục này đang chứa sản phẩm, không thể xóa!');
    }

    // Nếu danh mục không chứa sản phẩm, tiến hành xóa
    DB::table('categories')->where('id', $id)->delete();

    return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
}

}
