@extends('client.layouts.client')

@section('content')
    <div class="container py-5">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase text-primary">Vé Đặt Của Bạn</h2>
            <p class="text-muted">Quản lý chuyến đi đã đặt dễ dàng và nhanh chóng.</p>
            <a href="/list" class="btn btn-outline-primary mt-2">
                <i class="bi bi-arrow-left-circle"></i> Quay về danh sách chuyến
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tên người đặt</th>
                                <th>Email</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datVeDuLich as $ticket)
                                <tr class="text-center">
                                    <td>{{ $ticket->id }}</td>
                                    <td class="fw-semibold">{{ $ticket->ten_nguoi_dat }}</td>
                                    <td>{{ $ticket->email }}</td>
                                    <td>{{ $ticket->so_luong }}</td>
                                    <td class="text-success fw-bold">{{ number_format($ticket->tong_tien, 0, ',', '.') }} đ</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $ticket->hinh_thuc_thanh_toan)) }}</td>
                                    <td>
                                        @if($ticket->trang_thai == 1)
                                            <span class="badge bg-success">Đã xác nhận</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Chưa xác nhận</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('client.huyve', $ticket->id) }}" method="POST"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn hủy chuyến này không?')">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-x-circle"></i> Hủy
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="bi bi-ticket-perforated" style="font-size: 3rem;"></i>
                                        <p class="mt-3">Bạn chưa đặt vé nào.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Phân trang nếu cần --}}
        {{-- <div class="mt-4 d-flex justify-content-center">
            {{ $datVeDuLich->links() }}
        </div> --}}
    </div>
@endsection
