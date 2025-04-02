@extends('admin.layouts.app')
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
@section('title','thêm sản phẩm')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>sửa sản phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{$product->name}}" value="{{old('name', $product->name)}}">
                    @error('name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Giá sản phẩm</label>
                    <input type="text" name="price" class="form-control" value="{{$product->price}}" value="{{old('price', $product->price)}}">
                    @error('price')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Số lượng sản phẩm</label>
                    <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}" value="{{old('quantity', $product->quantity)}}">
                    @error('quantity')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">ảnh sản phẩm cũ </label> <br>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Hình ảnh" width="100" >
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select" >
                        
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($category->id == $product->category_id) selected  @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="form-label">mô tả sản phẩm</label>
                    <input type="text" name="description" class="form-control" value="{{$product->description}}">
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">sửa</button>
            </form>
        </div>
    </div>
@endsection