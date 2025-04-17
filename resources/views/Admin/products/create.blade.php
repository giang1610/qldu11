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
@section('title', 'thêm sản phẩm')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Thêm chuyến đi</h4>
        </div>
        <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="form-label">Tên chuyến đi</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Giá chuyến đi</label>
                    <input type="text" name="price" class="form-control">
                    @error('price')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Số lượng chuyến đi</label>
                    <input type="text" name="quantity" class="form-control">
                    @error('quantity')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Ảnh chuyến đi</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select">

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="form-label">Mô tả chuyến đi</label>
                    <input type="text" name="description" class="form-control">
                    @error('description')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Trang thái</label>
                    <select name="status" class="form-control">
                        <option value="1">Hoạt động</option>
                        <option value="0">tTạm dừng</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
@endsection