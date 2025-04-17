@extends('client.layouts.client')
@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <a href="/list" class="btn btn-primary btn-sm">list</a>

            <h4>Chi tiết sản phẩm</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th class="col-3">Tên sản phẩm:</th>
                                <td>{{$product->name}}</td>
                            </tr>

                            <tr>
                                <th class="col-3">Giá sản phẩm:</th>
                                <td>{{$product->price}}</td>
                            </tr>

                            <tr>
                                <th class="col-3">Số lượng sản phẩm:</th>
                                <td>{{$product->quantity}}</td>
                            </tr>

                            <tr>
                                <th class="col-3">Ảnh sản phẩm:</th>
                                <td><img src="{{ asset('storage/' . $product->image) }}" alt="Hình ảnh sản phẩm"
                                        class="img-thumbnail" style="max-width: 150px;"></td>
                            </tr>

                            <tr>
                                <th class="col-3">Danh mục:</th>
                                <td>{{$category->name ?? "Chưa có danh mục"}}</td>
                            </tr>

                            <tr>
                                <th class="col-3">Mô tả sản phẩm:</th>
                                <td>{{$product->description}}</td>
                            </tr>

                            <tr>
                                <th class="col-3">Trạng thái:</th>
                                <td>
                                    <span class="badge bg-{{ $product->status == 1 ? 'success' : 'danger' }}">
                                        {{ $product->status == 1 ? 'Hoạt động' : 'Tạm dừng' }}
                                    </span>
                                </td>
                            </tr> <br>

                        </tbody>

                    </table>
                    <a href="{{ route('client.dat', $product) }}" class="btn btn-primary">Đặt vé</a>
                    {{-- 5 sản phẩm liên quan --}}
                    <div class="related-products mt-5">
                        <h5>Sản phẩm liên quan</h5>
                        <div class="row">
                            @foreach($top5Products as $product)
                                <div class="col-md-2 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                            alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $product->name }}</h6>
                                            <p class="card-text">{{ number_format($product->price) }} đ</p>
                                            <a href="{{ route('client.show', $product->id) }}"
                                                class="btn btn-primary btn-sm">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection