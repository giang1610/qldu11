@extends('client.layouts.client')

@section('content')
    <div class="container py-4">
        @if (session('error'))
            <div class="mb-0 alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="mb-0 alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="text-center mb-4">
            <h2 class="text-primary">Danh sách vé đặt</h2>
            <a href="/list" class="btn btn-dark btn-sm mt-2">Quay về danh sách chuyến</a>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên người đặt</th>
                    <th>Email</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Hình thức thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Hủy chuyến</th>

                </tr>
            </thead>
            <tbody>
                @foreach($datVeDuLich as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->ten_nguoi_dat }}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ $ticket->so_luong }}</td>
                        <td>{{ number_format($ticket->tong_tien, 0, ',', '.') }} đ</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $ticket->hinh_thuc_thanh_toan)) }}</td>
                        <td>
                            {{ $ticket->trang_thai == 1 ? 'Đã xác nhận' : 'Chưa xác nhận' }}
                        </td>
                        <td>
                            <form action="{{ route('client.huyve', $ticket->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn hủy chuyến này không?')">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Hủy</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection