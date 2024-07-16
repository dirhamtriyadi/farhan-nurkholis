<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @canany(['stock-barang.list', 'stock-barang.create', 'stock-barang.edit', 'stock-barang.delete', 'barang-masuk.list', 'barang-masuk.create', 'barang-masuk.edit', 'barang-masuk.delete', 'barang-keluar.list', 'barang-keluar.create', 'barang-keluar.edit', 'barang-keluar.delete', 'laporan.list'])
                    <li class="nav-item {{ Route::is('stock-barang.*') | Route::is('barang-masuk.*') | Route::is('barang-keluar.*') | Route::is('laporan.*') ? 'menu-open ' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('stock-barang.*') | Route::is('barang-masuk.*') | Route::is('barang-keluar.*') | Route::is('laporan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Barang
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['stock-barang.list', 'stock-barang.create', 'stock-barang.edit', 'stock-barang.delete'])
                                <li class="nav-item">
                                    <a href="{{ route('stock-barang.index') }}" class="nav-link {{ Route::is('stock-barang.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stock Barang</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['barang-masuk.list', 'barang-masuk.create', 'barang-masuk.edit', 'barang-masuk.delete'])
                                <li class="nav-item">
                                    <a href="{{ route('barang-masuk.index') }}" class="nav-link {{ Route::is('barang-masuk.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang Masuk</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['barang-keluar.list', 'barang-keluar.create', 'barang-keluar.edit', 'barang-keluar.delete'])
                                <li class="nav-item">
                                    <a href="{{ route('barang-keluar.index') }}" class="nav-link {{ Route::is('barang-keluar.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Barang Keluar</p>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['laporan.list'])
                                <li class="nav-item">
                                    <a href="{{ route('laporan.index') }}" class="nav-link {{ Route::is('laporan.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany
                @canany(['user.list', 'user.create', 'user.edit', 'user.delete'])
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
