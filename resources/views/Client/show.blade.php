@extends('client.layouts.client')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <a href="/list" class="btn btn-light btn-sm">← Quay lại</a>
            <h4 class="mb-0">Chi tiết chuyến đi</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Hình ảnh chuyến đi"
                        class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-7">
                    <h3 class="mb-3">{{ $product->name }}</h3>

                    <p><strong>Giá chuyến đi:</strong> <span class="text-danger">{{ number_format($product->price) }} đ</span></p>
                    <p><strong>Thuộc tỉnh:</strong> {{ $category->name ?? 'Chưa có danh mục' }}</p>
                    <p><strong>Mô tả chuyến đi:</strong> {{ $product->description }}</p>
                    <p><strong>Trạng thái:</strong>
                        <span class="badge bg-{{ $product->status == 1 ? 'success' : 'danger' }}">
                            {{ $product->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}
                        </span>
                    </p>

                    <a href="{{ route('client.dat', $product) }}" class="btn btn-success btn-lg mt-3">Đặt vé ngay</a>
                </div>
            </div>

            {{-- Sản phẩm liên quan --}}
            <div class="related-products mt-5">
                <h4 class="mb-4">Các chuyến đi liên quan</h4>
                <div class="row g-3">
                    @foreach($top5Products as $relatedProduct)
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" 
                                     class="card-img-top" alt="{{ $relatedProduct->name }}"
                                     style="height: 150px; object-fit: cover;">
                                <div class="card-body p-2 d-flex flex-column">
                                    <h6 class="card-title mb-2">{{ Str::limit($relatedProduct->name, 25) }}</h6>
                                    <p class="text-danger fw-bold mb-2">{{ number_format($relatedProduct->price) }} đ</p>
                                    <a href="{{ route('client.show', $relatedProduct->id) }}" class="btn btn-primary btn-sm mt-auto">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
