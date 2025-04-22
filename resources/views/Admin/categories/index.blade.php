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
        <h2>Danh mục</h2>
        <a href="{{route('categories.create')}}" class="btn btn-primary">Thêm danh mục</a>
        <form method="GET" class="mb-4">
            <br>
            <div class="input-group shadow-sm rounded">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control border-primary" 
                    placeholder="🔍 Tìm kiếm danh mục..." 
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
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->name}}</td>
                        <td>{{$c->status ? "hành động" : "tạm dừng"}}</td>

                        <td>
                            <a href="{{route('categories.edit', $c->id)}}" class="btn btn-warning">Sửa</a>
                            <a href="{{route('categories.show', $c->id)}}" class="btn btn-info">Chi tiết</a>
                            <form action="{{route('categories.destroy', $c->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
@endsection