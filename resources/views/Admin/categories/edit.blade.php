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
@section('title', 'chi tiết san pham')
@section('content')
    <div class="cart-header">
        <h4>Chỉnh sửa danh mục</h4>
    </div>
    <div class="cart-body">
        <form action="{{route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" value="{{$category->name}}">
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                </select>
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhập</button>
        </form>
    </div>
@endsection