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
            <h4>Chi tiết chuyến đi</h4>
        </div>
        <div class="card-body">
            <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="form-label">Tên chuyến đi:</label>
                    {{$product->name}}

                </div>
                <div class="mb-3">
                    <label for="form-label">Giá chuyến đi:</label>
                    {{$product->price}}
                    @error('price')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form-label">Số lượng chuyến đi:</label>
                    {{$product->quantity}}

                </div>
                <div class="mb-3">
                    <label for="form-label">Ảnh chuyến đi: </label>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Hình ảnh" width="100">


                </div>
                <div class="mb-3">
                    <label class="form-label">Danh mục: </label>
                    <td>{{$category->name ?? "no file"}}</td>

                </div>
                <div class="mb-3">
                    <label for="form-label">Mô tả chuyến đi:</label>
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