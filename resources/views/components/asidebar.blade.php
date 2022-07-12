<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('opun.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h6 class="logo-text">SP Koperasi</h6>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="menu-label">Menu</li>
        <li>
            <a href="{{ route('index') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        <li class="menu-label">Manajemen Transaksi</li>
        @if (Auth::user()->role == '3')
            <li>
                <a href="{{ route('anggota.simpanan') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Data Simpanan</div>
                </a>
            </li>
            <li>
                <a href="{{ route('anggota.pinjaman') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Data Pinjaman</div>
                </a>
            </li>
            <li>
                <a href="{{ route('anggota.penarikan') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Data Penarikan</div>
                </a>
            </li>
            <li>
                <a href="{{ route('anggota.angsuran') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Data Angsuran</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->role != '3')
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Transaksi Anggota</div>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Pengajuan</div>
                </a>
                <ul>
                    <li> <a href="{{ route('pengajuan.simpan') }}"><i class="bx bx-right-arrow-alt"></i>Simpanan</a>
                    </li>
                    <li> <a href="{{ route('pengajuan.pinjam') }}"><i class="bx bx-right-arrow-alt"></i>Pinjaman</a>
                    </li>
                    <li> <a href="{{ route('pengajuan.tarik') }}"><i class="bx bx-right-arrow-alt"></i>Penarikan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('tabungan.index') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Tabungan Anggota</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == '1' || Auth::user()->role == '2')
            <li class="menu-label">Manajemen Data</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Data User</div>
                </a>
                <ul>
                    <li> <a href="{{ route('pengurus.index') }}"><i class="bx bx-right-arrow-alt"></i>Data
                            Pengurus</a>
                    </li>
                    <li> <a href="{{ route('pengawas.index') }}"><i class="bx bx-right-arrow-alt"></i>Data
                            Pengawas</a>
                    </li>
                    <li> <a href="{{ route('anggota.index') }}"><i class="bx bx-right-arrow-alt"></i>Data Anggota</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('simpanan.index') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Data Simpanan</div>
                </a>
            </li>
            <li>
                <a href="{{ route('pinjaman.index') }}">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Data Pinjaman</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->role != '3')
            <li class="menu-label">Laporan</li>
            <li>
                <a href="{{ route('cetakanggota.index') }}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Data Anggota</div>
                </a>
            </li>
            <li>
                <a href="{{ route('cetaksimpan.index') }}">
                    <div class="parent-icon"><i class="bx bx-wallet-alt"></i>
                    </div>
                    <div class="menu-title">Data Simpanan</div>
                </a>
            </li>
            <li>
                <a href="{{ route('cetakpinjam.index') }}">
                    <div class="parent-icon"><i class="bx bx-wallet-alt"></i>
                    </div>
                    <div class="menu-title">Data Pinjaman</div>
                </a>
            </li>
        @endif

        <li class="menu-label">User Manejemen</li>

        <li>
            <a href="{{ route('profil') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>

        <li>
            <a onclick="logsout()" href="#">
                <div class="parent-icon"> <i class="bx bx-log-out-circle"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
            <form method="POST" id="flog" class="" action="{{ route('logout') }}">
                @csrf
            </form>
        </li>
    </ul>
    <!--end navigation-->
</div>
<script>
    function logsout() {
        var x = document.getElementById('flog');
        x.submit();
    }
</script>
