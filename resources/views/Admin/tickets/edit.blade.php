@extends('admin.layouts.app')

@section('content')
<div class="container py-5">

    {{-- Hiển thị thông báo --}}
    @if (session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- Tiêu đề --}}
    <div class="text-center mb-5">
        <h2 class="text-uppercase fw-bold text-primary">Cập nhật trạng thái vé</h2>
        <a href="{{ route('admin.tickets.index2', $ve->id) }}" class="btn btn-outline-dark btn-sm mt-3">
            <i class="bi bi-arrow-left-circle"></i> Quay về danh sách chuyến
        </a>
    </div>

    {{-- Form chỉnh sửa --}}
    <div class="card shadow-lg border-0" style="max-width: 650px; margin: auto;">
        <div class="card-body p-5">
            <form action="{{ route('admin.tickets.update', $ve->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label text-muted">Tên người đặt:</label>
                    <div class="form-control-plaintext fw-bold">{{ $ve->ten_nguoi_dat }}</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Email:</label>
                    <div class="form-control-plaintext">{{ $ve->email }}</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Số lượng đặt:</label>
                    <div class="form-control-plaintext">{{ $ve->so_luong }}</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Tổng tiền:</label>
                    <div class="form-control-plaintext text-success fw-semibold">{{ number_format($ve->tong_tien, 0, ',', '.') }} đ</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Hình thức thanh toán:</label>
                    <div class="form-control-plaintext">{{ ucfirst(str_replace('_', ' ', $ve->hinh_thuc_thanh_toan)) }}</div>
                </div>

                <div class="mb-5">
                    <label for="trang_thai" class="form-label text-muted">Trạng thái đặt vé:</label>
                    <select class="form-select" name="trang_thai" id="trang_thai">
                        <option value="0" {{ $ve->trang_thai == 0 ? 'selected' : '' }}>Chưa xác nhận</option>
                        <option value="1" {{ $ve->trang_thai == 1 ? 'selected' : '' }}>Đã xác nhận</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-check-circle"></i> Cập nhật
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
