@extends('client.client')
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="text-primary">Xin chào, đây là trang người dùng sau đăng nhập</h1>
        <p class="lead">Bạn có thể mua hàng tại đây</p>
    </div>
    @if (Auth::check())
        <div class="col text-end">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </div>
    @endif
    <a href="{{route('client.listve')}}" class="btn btn-info">Danh sách vé đặt</a>
    <form method="GET" class="mb-3 d-flex justify-content-between">
        <div class="d-flex">
            <input type="text" name="search" class="form-control form-control-sm w-auto" placeholder="Tìm kiếm" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary mt-2 ms-2">Tìm</button>
        </div>
    
        <div class="d-flex">
            <select name="price_range" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto; height: calc(1.5em + .75rem + 2px);">
                <option value="">Chọn giá</option>
                <option value="under_500" {{ request('price_range') == 'under_500' ? 'selected' : '' }}>Dưới 500</option>
                <option value="500_1000" {{ request('price_range') == '500_1000' ? 'selected' : '' }}>500-1000</option>
                <option value="over_1000" {{ request('price_range') == 'over_1000' ? 'selected' : '' }}>Trên 1000</option>
            </select>
        </div>
    </form>
    
    
    
    
    
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
                                <a href="{{route('client.show', $product->id)}}" class="btn btn-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Không có sản phẩm nào.</p>
                @endforelse
            </div>
        </div> 
    </div>
</body>

</html>
@endsection
