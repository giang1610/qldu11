@extends('admin.layouts.app')
@if (session('success'))
    <div class="mb-0 alert alert-success">
        {{session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="mb-0 alert alert-success">
        {{session('error')}}
    </div>
@endif
@section('content')
    <div class="container">
        <h2>Danh sách chuyến đi</h2>
        <a href="{{route('products.create')}}" class="btn btn-primary btn-sm">Thêm mới</a> 
        <form method="GET" class="mb-4">
            <br>
            <div class="input-group shadow-sm rounded">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control border-primary" 
                    placeholder="🔍 Tìm kiếm sản phẩm..." 
                    value="{{ request('search') }}"
                    style="height: 48px;"
                >
                <button type="submit" class="btn btn-primary px-4" style="height: 48px;">
                    Tìm kiếm
                </button>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->name}}</td>
                        <td>{{$c->price}}</td>
                        <td>{{$c->quantity}}</td>
                        <td>
                            @if($c->image)
                                <img src="{{asset('storage/' . $c->image)}}" alt="{{$c->image}}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{$c->category->name ?? "no file"}}</td>
                        <td class="text-truncate" style="max-width: 200px;">
                            {{$c->description}}
                        </td>
                        <td>{{$c->status ? "Hành động" : "Tạm dừng"}}</td>
                        <td>
                            <a href="{{route('products.edit', $c->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="{{route('products.show', $c->id)}}" class="btn btn-info btn-sm">Chi tiết</a>
                            <form action="{{route('products.destroy', $c->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{$products->links()}}
    </div>
@endsection