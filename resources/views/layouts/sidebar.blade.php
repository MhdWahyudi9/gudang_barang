<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-box"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Gudang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Items -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang.index') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Barang</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang_masuk.index') }}">
            <i class="fas fa-fw fa-plus"></i>
            <span>Barang Masuk</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang_keluar.index') }}">
            <i class="fas fa-fw fa-minus"></i>
            <span>Barang Keluar</span>
        </a>
    </li>
</ul>
