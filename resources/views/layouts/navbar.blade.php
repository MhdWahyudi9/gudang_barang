<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow position-relative"
     style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%); box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 0 0 12px 12px;">

    <!-- Sidebar Toggle -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-2 text-white">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Title Tengah -->
    <div class="mx-auto text-center position-absolute w-100" style="pointer-events: none;">
        <h4 class="text-white fw-bold mb-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.2); letter-spacing: 0.5px;">
            Gudang Environment
        </h4>
    </div>

    <!-- Navbar Right -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center rounded shadow-sm px-2 py-1"
               href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
               style="background: #f1f1f1; border: 1px solid #ddd; transition: all 0.3s; box-shadow: 0 2px 6px rgba(0,0,0,0.08); font-size: 0.75rem; width: fit-content;">
                <span class="mr-1 d-none d-lg-inline text-dark fw-normal" style="font-size: 0.75rem;">
                    {{ Auth::user()->name ?? 'Admin' }}
                </span>
                <i class="fas fa-user-circle text-primary" style="font-size: 1rem;"></i>
            </a>
            <!-- Dropdown -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
