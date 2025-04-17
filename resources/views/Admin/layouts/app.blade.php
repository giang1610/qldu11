<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e14b23f1dc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('admin.layouts.block.sidebar')
        <!-- Main Content -->
        <div class="flex-grow-1">
            @include('Admin.layouts.block.header')
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>