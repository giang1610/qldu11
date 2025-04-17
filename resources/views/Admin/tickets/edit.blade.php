@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-center mb-4">
        <h2 class="text-primary">Danh sách vé đặt</h2>
        <a href="/list" class="btn btn-dark btn-sm mt-2">Quay về danh sách chuyến</a>
    </div>
   
    <form action="{{route('admin.tickets.update', $ve->id)}}" method="POST" enctype="multipart/form-data" class="p-4 rounded shadow bg-white" style="max-width: 600px; margin: auto;">
        @csrf
        @method('PUT')
    
        <h4 class="mb-4 text-center text-primary">Thông tin đặt vé</h4>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Tên người đặt:</label>
            <p class="form-control-plaintext">{{ $ve->ten_nguoi_dat }}</p>
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Email:</label>
            <p class="form-control-plaintext">{{ $ve->email }}</p>
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Số lượng đặt:</label>
            <p class="form-control-plaintext">{{ $ve->so_luong }}</p>
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Tổng tiền:</label>
            <p class="form-control-plaintext text-danger">{{ number_format($ve->tong_tien, 0, ',', '.') }} đ</p>
        </div>
    
        <div class="mb-3">
            <label class="form-label fw-bold">Hình thức thanh toán:</label>
            <p class="form-control-plaintext text-secondary">{{ ucfirst(str_replace('_', ' ', $ve->hinh_thuc_thanh_toan)) }}</p>
        </div>
    
        <div class="mb-4">
            <label for="trang_thai" class="form-label fw-bold">Trạng thái:</label>
            <select class="form-select" name="trang_thai">
                <option value="0" {{ $ve->trang_thai == 0 ? 'selected' : '' }}>Chưa xác nhận</option>
                <option value="1" {{ $ve->trang_thai == 1 ? 'selected' : '' }}>Đã xác nhận</option>
            </select>
        </div>
    
        <div class="text-center">
            <button type="submit" class="btn btn-success px-4">Đổi trạng thái</button>
        </div>
    </form>
    
   
    
</div>
@endsection
