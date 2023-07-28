<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-2">
            <img src="./gambar/logo.jpeg" alt="" width="50px">
            <a href="index.html">
                @if (Auth::user()->role_user == 1)
                    KASIR
                @elseIf(Auth::user()->role_user == 2)
                    KEPALA TOKO
                @endif
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img src="./gambar/logo.jpeg" alt="" width="50px"></a>
        </div>
        <ul class="sidebar-menu">
            @if (Auth::user()->role_user == 1)
                <li class="menu-header">Dashboard</li>
                <li class="{{ request()->is('dashboard-admin*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('dashboard.admin') }}"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a></li>
                <li class="menu-header">Data</li>
                {{-- <li class="{{ request()->is('data-barang*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('data-barang.index') }}"><i class="far fa-square"></i>
                        <span>Data Barang</span></a></li> --}}
                {{-- <li class="{{ request()->is('data-satuan*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('data-satuan.index') }}"><i class="far fa-square"></i>
                        <span>Satuan Barang</span></a></li> --}}
                <li class="{{ request()->is('data-pembelian*') ? 'active ' : '' }}"><a class="nav-link"
                        href="{{ route('data-pembelian.index') }}"><i class="far fa-chart-bar"></i>
                        <span>Data Pembelian</span></a></li>
                <li class="{{ request()->is('laporan*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('laporan.kasir') }}"><i class="far fa-calendar-alt"></i>
                        <span>Cetak Laporan</span></a></li>
            @elseif(Auth::user()->role_user == 2)
                <li class="menu-header">Dashboard</li>
                <li class="{{ request()->is('dashboard*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('dashboard.kepala.toko') }}"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a></li>
                <li class="menu-header">Data</li>
                <li @if (Request::segment(1) == 'data-barang') class="active" @endif><a class="nav-link"
                        href="{{ route('data-barang.index') }}"><i class="fas fa-drumstick-bite"></i>
                        <span>Data Barang</span></a></li>
                <li @if (Request::segment(1) == 'barangMasuk') class="active" @endif><a class="nav-link"
                        href="{{ route('barangMasuk') }}"><i class="far fa-calendar-plus"></i>
                        <span>Data Barang Masuk</span></a></li>
                <li @if (Request::segment(1) == 'barangKeluar') class="active" @endif><a class="nav-link"
                        href="{{ route('barangKeluar') }}"><i class="far fa-calendar-minus"></i>
                        <span>Data Barang keluar</span></a></li>
                <li class="dropdown @if (Request::segment(1) == 'laporanMasuk' || Request::segment(1) == 'laporanKeluar') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Laporan Barang</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('laporanMasuk') }}">Barang Masuk</a></li>
                        <li><a class="nav-link" href="{{ route('laporanKeluar') }}">Barang Keluar</a></li>
                    </ul>
                </li>
                <li class="dropdown @if (Request::segment(1) == 'laporan-harian' || Request::segment(1) == 'laporan-bulanan') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="far fa-money-bill-alt"></i>
                        <span>Laporan Keuntungan</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('laporan-harian') }}">Keuntungan Harian</a></li>
                        <li><a class="nav-link" href="{{ route('laporan-bulanan') }}">Keuntungan Bulanan</a></li>
                        {{-- <li><a class="nav-link" href="{{ route('laporan-tahunan') }}">Keuntungan Tahunan</a></li> --}}
                    </ul>
                </li>
                <li class="menu-header">User</li>
                <li class="{{ request()->is('users*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('users.index') }}"><i class="fas fa-users"></i>
                        <span>Users</span></a></li>
            @endif

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
