<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Laravel POS</span>
        </a>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('dashboard') }}">
                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
            </a>
        </li>

        <ul class="sidebar-nav">

            @if (auth()->user()->can('lihat user'))
                <li class="sidebar-item">
                    <a data-target="#user" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Manajemen User</span>
                    </a>
                    <ul id="user" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                        @role('admin')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('roles.index') }}">Role</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('users.permissions') }}">Hak akses</a>
                            </li>
                        @endrole
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('users.index') }}">User</a>
                            </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->can('lihat barang')) 
                <li class="sidebar-item">
                    <a data-target="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Manajemen Barang</span>
                    </a>
                    <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">Kategori</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('products.index') }}">Barang</a></li>
                    </ul>
                </li>
            @endif

            <li class="sidebar-item">
                <a data-target="#forms" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Transaksi</span>
                </a>
                <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    @role('admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('purchases.index') }}">Pembelian</a>
                        </li>
                    @endrole
                    @role('kasir')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('sales.index') }}">Penjualan</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="forms-basic-inputs.html">Pengembalian</a>
                        </li>
                    @endrole
                </ul>
            </li>

            @role('admin')
                <li class="sidebar-item">
                    <a data-target="#report" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Laporan</span>
                    </a>
                    <ul id="report" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="">Laporan Penjualan</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="">Laporan Pembelian</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="">Laporan Pengembalian</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="">Laporan Bulanan</a></li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="">
                        <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Histori Barang</span>
                    </a>
                </li>
            @endrole
        </ul>
    </div>
</nav>