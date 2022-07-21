<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/wifi-signal.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">WEB INVENTORY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- logic setting avatar otomatis --}}
                @php
                    $initial = explode(' ', auth()->user()->name);
                    $avatar = 'https://ui-avatars.com/api/?name=' . $initial[0] . '+' . $initial[1];
                @endphp
                <img src={{ $avatar }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ $title == 'Dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/device/in" class="nav-link {{ $title == 'Perangkat Masuk' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Perangkat Masuk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/device/on-hand-good" class="nav-link {{ $title == 'Perangkat Bagus' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check-double"></i>
                        <p>
                            Perangkat Bagus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/device/on-hand-bad" class="nav-link {{ $title == 'Perangkat Rusak' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-times-circle"></i>
                        <p>
                            Perangkat Rusak
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/device/out" class="nav-link {{ $title == 'Perangkat Keluar' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Perangkat Terjual
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user" class="nav-link {{ $title == 'User' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        <button href="/" class="btn btn-sm bg-gradient-navy nav-link ms-0">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
