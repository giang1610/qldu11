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
        <a href="{{route('products.create')}}" class="btn btn-primary">Thêm mới</a>
        <form method="GET" class="mb-3 mt-2">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="tìm kiếm" value="{{request('search')}}">
                <button type="submit" class="btn btn-primary">Tìm</button>
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

                            {{-- <img src="{{ asset('storage/' . $c->image) }}" alt="Hình ảnh" width="100"> --}}
                            @if($c->image)
                                <img src="{{asset('storage/' . $c->image)}}" alt="{{$c->image}}" width="100" height="100">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>

                        <td>{{$c->category->name ?? "no file"}}</td>
                        <td>{{$c->description}}</td>
                        <td>{{$c->status ? "hành động" : "tạm dừng"}}</td>

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