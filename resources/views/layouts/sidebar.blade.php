
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    
    <li class="{{ (request()->is('superadmin/user*')) ? 'active' : '' }}"><a href="/superadmin/user"><i class="fa fa-list"></i> <span>Data User</span></a></li>
    <li class="{{ (request()->is('superadmin/petugas*')) ? 'active' : '' }}"><a href="/superadmin/petugas"><i class="fa fa-list"></i> <span>Data Petugas</span></a></li>
    <li class="{{ (request()->is('superadmin/kategori*')) ? 'active' : '' }}"><a href="/superadmin/kategori"><i class="fa fa-list"></i> <span>Data Jenis Kendaraan</span></a></li>
    <li class="{{ (request()->is('superadmin/registrasi*')) ? 'active' : '' }}"><a href="/superadmin/registrasi"><i class="fa fa-list"></i> <span>Data Registrasi</span></a></li>
    <li class="{{ (request()->is('superadmin/pemeriksaan*')) ? 'active' : '' }}"><a href="/superadmin/pemeriksaan"><i class="fa fa-list"></i> <span>Data Pemeriksaan</span></a></li>
    <li class="{{ (request()->is('superadmin/surat*')) ? 'active' : '' }}"><a href="/superadmin/surat"><i class="fa fa-list"></i> <span>Data Surat</span></a></li>

    <li class="{{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}"><a href="/superadmin/laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>

    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    
    @endif
    </ul>
    
</section>