<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- HEADER -->
    <header class="bg-primary text-white text-center p-3">
        <h1>Website Bán Hàng</h1>
        <nav>
            {{-- <a href="{{ route('home') }}" class="text-white mx-2">Trang chủ</a>
            <a href="{{ route('products.list') }}" class="text-white mx-2">Sản phẩm</a>
            <a href="{{ route('contact') }}" class="text-white mx-2">Liên hệ</a> --}}
        </nav>
    </header>

    <!-- Nội dung chính -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2025 Website Bán Hàng. All rights reserved.</p>
    </footer>
</body>
</html>
