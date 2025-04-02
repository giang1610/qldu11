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
@section('title','chi tiết san pham')
@section('content')
   <div class="card">
        <div class="cart-header">
            <h4>chi tiết danh mục</h4>
        </div>
        <div class="cart-body">
            <form action="{{route('categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="form-label">Tên danh mục:</label>
                    {{$category->name}}
                   
                </div>
                <div class="mb-3">
                    <label class="form-label">Trạng thái:</label>
                   
                        {{ $category->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}
                   
                </div>
                
               
            </form>
        </div>
   </div>
@endsection
