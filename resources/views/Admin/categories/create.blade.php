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
@section('title', 'thêm danh mục')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thêm danh mục</h4>
        </div>
        <div class="card-body">
            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="form-label">Tên danh mục</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Trang thái</label>
                    <select name="status" class="form-control">
                        <option value="1">hoạt động</option>
                        <option value="0">tạm dừng</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">thêm mới</button>
            </form>
        </div>
    </div>
@endsection