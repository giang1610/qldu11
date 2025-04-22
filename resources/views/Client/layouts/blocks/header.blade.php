<nav class="navbar navbar-expand-lg navbar-dark px-3">
    <a class="navbar-brand" href="/list">traveloke</a>

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
        {{-- <div class="d-flex align-items-center">
            @if (Auth::check())
                <span class="me-3 text-white">Xin chào, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Đăng nhập</a>
            @endif
        </div> --}}
        <ul class="navbar-nav ms-auto">
            @auth
              <li class="nav-item">
                <span class="nav-link">Chào, {{ Auth::user()->name }}</span>
              </li>
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-link nav-link">Đăng xuất</button>
                </form>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
              </li>
            @endauth
          </ul>
        
    </div>
</nav>