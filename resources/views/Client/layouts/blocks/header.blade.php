<nav class="navbar navbar-expand-lg navbar-dark px-3">
    <a class="navbar-brand" href="#">traveloke</a>

    <div class="collapse navbar-collapse">
        <!-- Menu bên trái -->
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Khách sạn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Vé máy bay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Đưa đón sân bay</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Cho thuê xe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('client.listve')}}">Danh sách vé đặt</a>
            </li>
        </ul>

        <!-- Nút đăng nhập / đăng ký bên phải -->
        <div class="d-flex">
            @if (Auth::check())
                <div class="col text-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light me-2">Đăng xuất</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</nav>