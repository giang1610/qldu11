@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="text-primary">Xin chào, đây là trang người dùng</h1>
        <p class="lead">Bạn phải đăng nhập thì mới mua được hàng</p>
        <a href="/login" class="btn btn-primary">Đăng nhập</a>
    </div>
    @if (Auth::check())
        <div class="col text-end">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </div>
    @endif

</body>

</html>
