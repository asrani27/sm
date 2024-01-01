
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    <li class="{{ (request()->is('superadmin/nomor')) ? 'active' : '' }}"><a href="/superadmin/nomor"><i class="fa fa-phone"></i> <span>Nomor</span></a></li>
    <li class="{{ (request()->is('superadmin/wa')) ? 'active' : '' }}"><a href="/superadmin/wa"><i class="fa fa-whatsapp"></i> <span>WA Blast</span></a></li>
    
    <li class="{{ (request()->is('superadmin/dpt*')) ? 'active' : '' }}"><a href="/superadmin/dpt"><i class="fa fa-list"></i> <span>Data DPT</span></a></li>
    <li class="{{ (request()->is('superadmin/user*')) ? 'active' : '' }}"><a href="/superadmin/user"><i class="fa fa-list"></i> <span>Data User</span></a></li>
    <li class="{{ (request()->is('superadmin/kecamatan*')) ? 'active' : '' }}"><a href="/superadmin/kecamatan"><i class="fa fa-list"></i> <span>Data Kecamatan</span></a></li>
    <li class="{{ (request()->is('superadmin/kelurahan*')) ? 'active' : '' }}"><a href="/superadmin/kelurahan"><i class="fa fa-list"></i> <span>Data Kelurahan</span></a></li>
    <li class="{{ (request()->is('superadmin/rt*')) ? 'active' : '' }}"><a href="/superadmin/rt"><i class="fa fa-list"></i> <span>Data RT</span></a></li>
    <li class="{{ (request()->is('superadmin/sm*')) ? 'active' : '' }}"><a href="/superadmin/sm"><i class="fa fa-users"></i> <span>Data SM</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    <li class="{{ (request()->is('user')) ? 'active' : '' }}"><a href="/user"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    <li class="{{ (request()->is('user/sm*')) ? 'active' : '' }}"><a href="/user/sm"><i class="fa fa-users"></i> <span>Data SM</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @endif
    </ul>
    
</section>