@extends('client.layouts.client')
@if (session('error'))
    <div class="mb-0 alert alert-danger">{{ session('error') }}</div>
@endif
@if (session('success'))
    <div class="mb-0 alert alert-success">{{ session('success') }}</div>
@endif
@section('slide')
    <div id="travelokaCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#travelokaCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#travelokaCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#travelokaCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/slide/1.webp') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/slide/image.png') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Chinh phục những ngọn núi cao</h5>
                    <p>Trải nghiệm không khí trong lành và khung cảnh tuyệt đẹp.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/slide/2.webp') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <h5>Thành phố hiện đại và sôi động</h5>
                    <p>Khám phá những địa điểm hot nhất trong nước và quốc tế.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#travelokaCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#travelokaCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- Cột 3/12: Danh mục -->
        <div class="col-md-3">
            <h4 class="mb-3">Danh mục</h4>
            <ul class="list-group">
                <li class="list-group-item">
                <a href="{{ route('client.list') }}" class="text-decoration-none">Tất cả sản phẩm</a>
            </li>
                @foreach($categories as $category)
                    <li class="list-group-item">
                        
                        <a href="{{ route('client.category', $category->id) }}" class="text-decoration-none">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <form method="GET" class="mb-3 mt-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm kiếm"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm">Tìm</button>
                </div>
            </form>

            <form method="GET" class="mb-3">
                <div class="input-group input-group-sm" style="max-width: 320px;">
                    <label class="input-group-text" for="price_range">Giá</label>
                    <select name="price_range" id="price_range" class="form-select" onchange="this.form.submit()">
                        <option value="">Chọn giá</option>
                        <option value="under_500" {{ request('price_range') == 'under_500' ? 'selected' : '' }}>Dưới 500
                        </option>
                        <option value="500_1000" {{ request('price_range') == '500_1000' ? 'selected' : '' }}>500-1000
                        </option>
                        <option value="over_1000" {{ request('price_range') == 'over_1000' ? 'selected' : '' }}>Trên 1000
                        </option>
                    </select>
                </div>
            </form>

        </div>
        <!-- Cột 9/12: Danh sách sản phẩm -->
        <div class="col-md-9">
            <h4 class="mb-4">Danh sách chuyến đi</h4>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top rounded-top"
                                alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                                <p class="card-text fw-bold text-danger mb-1">{{ number_format($product->price) }} VND</p>
                                <p class="text-muted small mb-3">Số lượng: {{ $product->quantity }}</p>
                                <a href="{{ route('client.show', $product->id) }}" class="btn btn-outline-primary mt-auto">Xem
                                    chi tiết</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Không có sản phẩm nào.</p>
                    </div>
                @endforelse
            </div>
        </div> 
    </div>
{{$products->links()}}
@endsection
