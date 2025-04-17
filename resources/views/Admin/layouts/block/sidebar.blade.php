<div class="sidebar d-flex flex-column">
    <h4>Admin Panel</h4>
    <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link"><i
                    class="fas fa-tachometer-alt"></i>
                Quản lý chuyến đi</a></li>
        <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link"><i class="fas fa-users"></i>
                Quản lý danh mục</a>
        </li>
        <li class="nav-item"><a href="{{ route('admin.tickets.index2') }}" class="nav-link"><i
                    class="fas fa-chart-bar"></i>
                Quản lý vé đặt</a>
        </li>
    </ul>
</div>