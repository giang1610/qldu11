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
        <h2 class="text-uppercase fw-bold text-primary">Danh sách vé đặt</h2>
    </div>

    {{-- Bảng danh sách vé --}}
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Tên người đặt</th>
                            <th>Email</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datVeDuLich as $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->ten_nguoi_dat }}</td>
                                <td>{{ $ticket->email }}</td>
                                <td>{{ $ticket->so_luong }}</td>
                                <td class="text-success fw-semibold">{{ number_format($ticket->tong_tien, 0, ',', '.') }} đ</td>
                                <td>
                                    @if ($ticket->hinh_thuc_thanh_toan == 'tien_mat')
                                        <span class="badge bg-success">Tiền mặt</span>
                                    @elseif($ticket->hinh_thuc_thanh_toan == 'chuyen_khoan')
                                        <span class="badge bg-primary">Chuyển khoản</span>
                                    @elseif($ticket->hinh_thuc_thanh_toan == 'vi_dien_tu')
                                        <span class="badge bg-warning text-dark">Ví điện tử</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->trang_thai == 1)
                                        <span class="badge bg-success">Đã xác nhận</span>
                                    @else
                                        <span class="badge bg-secondary">Chưa xác nhận</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i> Sửa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
