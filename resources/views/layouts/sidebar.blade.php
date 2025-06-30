<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon" style="display: flex; align-items: center;">
            <img src="{{ asset('images/logo-pertamina.png') }}" style="width: 50px;">
        </div>
        <div class="sidebar-brand-text mx-2 text-left" style="line-height: 1.2;">
            GUDANG <br> ENVIRONMENT
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active border-left border-white' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Barang -->
    <li class="nav-item {{ request()->routeIs('barang.*') ? 'active border-left border-white' : '' }}">
        <a class="nav-link" href="{{ route('barang.index') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Barang</span>
        </a>
    </li>

    <!-- Barang Masuk -->
    <li class="nav-item {{ request()->routeIs('barang_masuk.*') ? 'active border-left border-white' : '' }}">
        <a class="nav-link" href="{{ route('barang_masuk.index') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Barang Masuk</span>
        </a>
    </li>

    <!-- Barang Keluar -->
    <li class="nav-item {{ request()->routeIs('barang_keluar.*') ? 'active border-left border-white' : '' }}">
        <a class="nav-link" href="{{ route('barang_keluar.index') }}">
            <i class="fas fa-fw fa-minus"></i>
            <span>Barang Keluar</span>
        </a>
    </li>

</ul>
