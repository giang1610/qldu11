<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-info" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-light" href="#">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="#">Báo cáo</a></li>
                <li class="nav-item"><a class="nav-link text-light" href="#">Cài đặt</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-light">Đăng xuất</button>
                </form>
            </ul>
        </div>
    </div>
</nav>