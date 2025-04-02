@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
    <div class="row">
        <!-- Cột 3/12: Danh mục -->
        <div class="col-md-3">
            <h4 class="mb-3">Danh mục</h4>
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <a href="" class="text-decoration-none">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Cột 9/12: Danh sách sản phẩm -->
        <div class="col-md-9">
            <h4 class="mb-3">Sản phẩm</h4>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text fw-bold text-danger">{{ number_format($product->price) }} VND</p>
                                <p class="text-muted small">Số lượng: {{ $product->quantity }}</p>
                                <a href="{{route('products.show', $product->id)}}" class="btn btn-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Không có sản phẩm nào.</p>
                @endforelse
            </div>
        </div> 
    </div>
@endsection
