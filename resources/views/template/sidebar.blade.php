<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/img/puskesmas.png') }}" style="width: 40px" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Puskesmas</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('/*')) ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pasien
    </div>

    <!-- Nav Item - Kelola pasien -->
    <li class="nav-item {{ (request()->is('pasien*')) ? 'active' : '' }}">
        <a class="nav-link" href="/pasien">
            <i class="fas fa-fw fa-user"></i>
            <span>Kelola Pasien</span></a>
    </li>

    <!-- Nav Item - Kelola pemeriksaan -->
    <li class="nav-item {{ (request()->is('pemeriksaan*')) ? 'active' : '' }}">
        <a class="nav-link" href="/pemeriksaan">
            <i class="fas fa-fw fa-book-medical"></i>
            <span>Pemeriksaan</span></a>
    </li>

    <!-- Nav Item - Kelola pemeriksaan ringan -->
    <li class="nav-item {{ (request()->is('pemeriksaan_ringan*')) ? 'active' : '' }}">
        <a class="nav-link" href="/pemeriksaan_ringan">
            <i class="fas fa-fw fa-book-medical"></i>
            <span>Pemeriksaan Ringan</span></a>
    </li>

    <!-- Nav Item - Kelola pemeriksaan berat -->
    <li class="nav-item {{ (request()->is('pemeriksaan_berat*')) ? 'active' : '' }}">
        <a class="nav-link" href="/pemeriksaan_berat">
            <i class="fas fa-fw fa-book-medical"></i>
            <span>Pemeriksaan Berat</span></a>
    </li>

    <!-- Nav Item - Kelola Antrian -->
    {{-- <li class="nav-item {{ (request()->is('antrian*')) ? 'active' : '' }}">
        <a class="nav-link" href="/antrian">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Antrian</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>

    <!-- Nav Item - Kelola Dokter -->
    <li class="nav-item {{ (request()->is('dokter*')) ? 'active' : '' }}">
        <a class="nav-link" href="/dokter">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Kelola Dokter</span></a>
    </li>

    <!-- Nav Item - Kelola Poli -->
    <li class="nav-item {{ (request()->is('poli*')) ? 'active' : '' }}">
        <a class="nav-link" href="/poli">
            <i class="fas fa-fw fa-hospital-user"></i>
            <span>Kelola Poli</span></a>
    </li>

    <!-- Nav Item - Kelola Praktik -->
    <li class="nav-item {{ (request()->is('praktik*')) ? 'active' : '' }}">
        <a class="nav-link" href="/praktik">
            <i class="fas fa-fw fa-hospital"></i>
            <span>Kelola Praktik</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Report Data
    </div>

    <!-- Nav Item - Kelola Dokter -->
    <li class="nav-item {{ (request()->is('report/pemeriksaan*')) ? 'active' : '' }}">
        <a class="nav-link" href="/report/pemeriksaan">
            <i class="fas fa-file"></i>
            <span>Report Data Pemeriksaan</span></a>
    </li>

    <!-- Nav Item - Kelola Poli -->
    <li class="nav-item {{ (request()->is('report/dokter*')) ? 'active' : '' }}">
        <a class="nav-link" href="/report/dokter">
            <i class="fas fa-file"></i>
            <span>Report Data Dokter</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
