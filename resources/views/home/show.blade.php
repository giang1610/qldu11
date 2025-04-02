@extends('layouts.client')
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
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="form-label">Tên sản phẩm:</label>
                    {{$product->name}}
                   
                </div>
                <div class="mb-3">
                    <label for="form-label">Giá sản phẩm:</label>
                    {{$product->price}}
                    @error('price')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Số lượng sản phẩm:</label>
                    {{$product->quantity}}
                    
                </div>
                <div class="mb-3">
                    <label for="form-label">ảnh sản phẩm : </label> 
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Hình ảnh" width="100">
                   
                    
                </div>
                <div class="mb-3">
                    <label class="form-label">Danh mục: </label>
                    
                        
                        {{-- @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($category->id == $product->category_id) selected  @endif>{{ $category->name }}</option>
                        @endforeach --}}
                       {{ $product->category_name }}
                    {{-- {{$product->category_name}} --}}
                </div>
                <div class="mb-3">
                    <label for="form-label">mô tả sản phẩm:</label>
                    {{$product->description}}
                
                </div>
                <div class="mb-3">
                    <label for="form-label">Trạng thái:</label>
                   
                        {{ $product->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}
                  
                </div>
                
                
            </form>
        </div>
    </div>
@endsection