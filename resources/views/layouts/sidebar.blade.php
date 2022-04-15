<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('customer') ? 'active' : '' }}">
            <a href="{{ route('customer') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Customer</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('product') ? 'active' : '' }}">
            <a href="{{ route('product') }}" class='sidebar-link'>
                <i class="bi bi-archive-fill"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('orderan') ? 'active' : '' }}">
            <a href="{{ route('orderan') }}" class='sidebar-link'>
                <i class="bi bi-bag-check-fill"></i>
                <span>Orderan</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}" class='sidebar-link'>
                <i class="bi bi-person-fill"></i>
                <span>Admin</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('laporan') ? 'active' : '' }}">
            <a href="{{ route('laporan') }}" class='sidebar-link'>
                <i class="bi bi-file-earmark-text-fill"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('logout') }}" class='sidebar-link'>
                <i class="bi bi-box-arrow-left text-danger"></i>
                <span class="text-danger">Logout</span>
            </a>
        </li>


    </ul>
</div>
