@extends('client.client')
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Form Đặt Vé</h4>
            <a href="/list" class="btn btn-primary btn-sm">Danh sách</a>
        </div>
        <div class="card-body">
            <form action="{{ route('client.dat.store', $product->id) }}" method="POST">
                @csrf
                {{-- @method('PUT') --}}

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="">Tên chuyến đi:</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="">Giá vé:</label>
                        <input type="text" class="form-control" id="gia_ve" value="{{ number_format($product->price, 0, ',', '.') }} đ" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="so_luong">Số lượng người:</label>
                        <input type="number" class="form-control" name="so_luong" id="so_luong" value="1" min="1">
                    </div>
                    <div class="col-md-4">
                        <label for="ten_nguoi_dat">Tên người đặt:</label>
                        <input type="text" class="form-control" name="ten_nguoi_dat">
                        @error('ten_nguoi_dat')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email">
                        @error('email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="">Tổng tiền:</label>
                    <input type="text" class="form-control" id="tong_tien" value="{{ number_format($product->price, 0, ',', '.') }} đ" disabled>
                </div>
                <div class="mb-3">
                    <label for="hinh_thuc_thanh_toan">Hình thức thanh toán:</label>
                    <select name="hinh_thuc_thanh_toan" id="hinh_thuc_thanh_toan" class="form-control" >
                        <option value="">-- Chọn hình thức thanh toán --</option>
                        <option value="tien_mat">Tiền mặt</option>
                        <option value="chuyen_khoan">Chuyển khoản ngân hàng</option>
                        <option value="vi_dien_tu">Ví điện tử (Momo, ZaloPay...)</option>
                    </select>
                    @error('hinh_thuc_thanh_toan')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                

                <button type="submit" class="btn btn-success w-100 mt-3">Đặt vé</button>
            </form>
        </div>
    </div>
</div>

<script>
    const giaVe = {{ $product->price }};
    const soLuongInput = document.getElementById('so_luong');
    const tongTienInput = document.getElementById('tong_tien');

    soLuongInput.addEventListener('input', function () {
        let sl = parseInt(this.value);
        if (sl >= 1) {
            let tong = sl * giaVe;
            tongTienInput.value = tong.toLocaleString('vi-VN') + ' đ';
        }
    });
</script>
@endsection
