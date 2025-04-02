<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models;
use App\Models\Category;
use App\Models\Product;
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
        // dạng query builder
        // $query = DB::table('categories')->orderBy('id','desc');

        // if($request->has('search')){
        //     $query->where('name','like','%' . $request->search .'%');
        // }

        // $categories = $query->paginate(5);
        // return view('categories.index', compact('categories'));

        //dạng Eloquent
        $query = Category::query();
        if($request->has('search')){
            $query->where('name','like','%' . $request->search .'%');
        }
        $categories = $query->orderBy('id','desc')->paginate(5);
        return view('admin.categories.index', compact('categories'));
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
        // Category::query('categories')->insert([
        //     'name'=>$request->name,
        //     'status'=>(bool) $request->status,
        // ]);
        // return redirect()->route('categories.index')->with('success','thêm danh mục thành công');
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category =  Category::query('categories')->where('id',$id)->first();
       //trả dữ liệu về view
       return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //lấy dữ liệu của bản ghi cần chỉnh sửa
    //    $category =  Category::query('categories')->where('id',$id)->first();
    //    //trả dữ liệu về view
    //    return view('categories.edit', compact('category'));


    return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // Category::where('id', $id)->update([
        //     'name' => $request->name,
        //     'status' => (bool) $request->status
        // ]);
    
        // return redirect()->route('categories.index')->with('success', 'Chỉnh sửa thành công');

        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'sửa ok');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
{
    // Kiểm tra xem danh mục có sản phẩm nào không
    // $productCount = Category::find($id)->products()->count();


    // if ($productCount > 0) {
    //     // Nếu có sản phẩm, không cho phép xóa và hiển thị thông báo
    //     return redirect()->route('categories.index')->with('error', 'Danh mục này đang chứa sản phẩm, không thể xóa!');
    // }

    // // Nếu danh mục không chứa sản phẩm, tiến hành xóa
    // Category::query('categories')->where('id', $id)->delete();

    // return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
    $category->delete();
    return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
}

}
