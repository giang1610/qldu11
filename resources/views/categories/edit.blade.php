@extends('layouts.app')
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success">
        {{session('error')}}
    </div>
@endif
@section('title','chi tiết san pham')
@section('content')
   <div class="card">
        <div class="cart-header">
            <h4>chỉnh sửa danh mục</h4>
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
                    <label for="form-label">Trang thái</label>
                    <select name="status" class="form-label">
                        <option value="1">{{$category->status == 1 ? 'selected' : ''}} Hoạt động</option>
                        <option value="0">{{$category->status == 0 ? 'selected' : ''}} tạm dừng</option>
                    </select>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">cập nhập</button>
            </form>
        </div>
   </div>
@endsection
