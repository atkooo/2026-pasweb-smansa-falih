<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard - Paskibra Ganesha')</title>
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/daterangepicker/3.1/daterangepicker.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f4f7fe;
            color: #333;
        }
        
        .wrapper .content-wrapper {
            background-color: #f4f7fe !important;
        }
        
        .main-header {
            border-bottom: none !important;
            background-color: #f4f7fe !important;
            padding: 0.5rem 0.5rem 0 0.5rem;
        }

        .main-sidebar {
            background-color: #ffffff !important;
            box-shadow: 4px 0 20px rgba(0,0,0,0.03) !important;
            border-right: none !important;
        }
        
        .main-footer {
            background-color: transparent !important;
            border-top: none !important;
            font-size: 0.8rem;
            color: #9ca3af;
            padding: 1rem 1.5rem;
        }
        .main-footer a {
            color: #6366f1;
            font-weight: 500;
        }

        .brand-link {
            background-color: #ffffff !important;
            color: #111827 !important;
            border-bottom: none !important;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 1.5rem 1rem !important;
            gap: 15px;
        }
        
        .brand-link .brand-image {
            float: none;
            margin-right: 10px;
        }

        .nav-sidebar .nav-item {
            margin-bottom: 2px;
            padding: 0;
        }
        
        .nav-sidebar .nav-header {
            color: #9ca3af !important;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 1rem 1.5rem 0.5rem !important;
        }

        .nav-sidebar .nav-link {
            border-radius: 0 !important; /* No Pill */
            padding: 0.75rem 1.5rem !important;
            color: #9ca3af !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            position: relative;
        }

        .nav-sidebar .nav-link p, .nav-sidebar .nav-link i {
            color: #9ca3af;
        }

        .nav-sidebar .nav-link:hover {
            background-color: rgba(239, 68, 68, 0.03) !important;
            color: #ef4444 !important;
        }
        .nav-sidebar .nav-link:hover i, .nav-sidebar .nav-link:hover p {
            color: #ef4444 !important;
        }

        .nav-sidebar .nav-link.active {
            background-color: rgba(239, 68, 68, 0.05) !important;
            color: #ef4444 !important;
            box-shadow: none !important;
        }
        
        .nav-sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 4px;
            background-color: #ef4444;
            border-radius: 4px 0 0 4px;
        }

        .nav-sidebar .nav-link.active i, .nav-sidebar .nav-link.active p {
            color: #ef4444 !important;
        }
        
        .user-panel {
            border-bottom: none !important;
            margin-bottom: 1rem;
            padding-bottom: 0;
        }
        
        .user-panel .info a {
            color: #111827 !important;
            font-weight: 600;
        }

        .user-panel .text-success {
            color: #10b981 !important;
        }
        
        /* Fix Collapsed Sidebar State and Disable Hover Expand */
        .sidebar-collapse .nav-sidebar .nav-item,
        .sidebar-is-opening .nav-sidebar .nav-item {
            padding: 0 !important;
            margin: 0 !important;
        }
        .sidebar-collapse .nav-sidebar .nav-link,
        .sidebar-is-opening .nav-sidebar .nav-link {
            padding: 0.75rem 0 !important;
            justify-content: center !important;
            width: 4.6rem !important;
        }
        .sidebar-collapse .nav-sidebar .nav-link i,
        .sidebar-is-opening .nav-sidebar .nav-link i {
            margin: 0 !important;
        }
        
        /* Force disable expansion visually */
        body.sidebar-mini.sidebar-collapse .main-sidebar:hover,
        body.sidebar-mini.sidebar-is-opening .main-sidebar {
            width: 4.6rem !important;
        }
        
        body.sidebar-collapse .brand-text,
        body.sidebar-collapse .nav-sidebar .nav-link p,
        body.sidebar-collapse .nav-header,
        body.sidebar-mini.sidebar-collapse .main-sidebar:hover .brand-text,
        body.sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-link p,
        body.sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-header,
        body.sidebar-is-opening .brand-text,
        body.sidebar-is-opening .nav-sidebar .nav-link p,
        body.sidebar-is-opening .nav-header {
            display: none !important;
            width: 0 !important;
            opacity: 0 !important;
        }
        
        /* Logo Centering */
        .sidebar-collapse .brand-link,
        .sidebar-is-opening .brand-link,
        body.sidebar-mini.sidebar-collapse .main-sidebar:hover .brand-link {
            padding: 1.5rem 0 !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            width: 4.6rem !important;
            overflow: hidden !important;
            gap: 0 !important;
        }
        .sidebar-collapse .brand-link > img,
        .sidebar-is-opening .brand-link > img,
        body.sidebar-mini.sidebar-collapse .main-sidebar:hover .brand-link > img {
            margin: 0 !important;
            display: block !important;
            max-height: 35px !important;
        }
        .sidebar-collapse .brand-logo-icon,
        .sidebar-is-opening .brand-logo-icon {
            margin-right: 0 !important;
        }

        /* Modern Card Overrides */
        .card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            background: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            border-bottom: none;
            background-color: transparent;
            padding: 1.5rem 1.5rem 0.5rem 1.5rem;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #111827;
        }
        
        .card-body {
            padding: 1.5rem;
        }

        /* Red & White Gradient Cards */
        .bg-gradient-red-1 {
            background: linear-gradient(135deg, #f87171, #ef4444) !important;
            color: white !important;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25) !important;
        }
        .bg-gradient-red-2 {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            color: white !important;
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.25) !important;
        }
        .bg-gradient-white {
            background: #ffffff !important;
            color: #111827 !important;
            border: 1px solid rgba(239, 68, 68, 0.1) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03) !important;
        }
        
        .stat-card-gradient {
            border-radius: 24px;
            padding: 1.75rem 2rem;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            transition: transform 0.3s ease;
        }
        .stat-card-gradient:hover { transform: translateY(-5px); }
        
        .stat-card-gradient .stat-info {
            display: flex;
            flex-direction: column;
        }
        .stat-card-gradient .value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 0.25rem;
        }
        .stat-card-gradient .label {
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.9;
        }
        .stat-card-gradient .icon-circle {
            width: 65px;
            height: 65px;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .bg-gradient-red-1 .icon-circle { color: #ef4444; }
        .bg-gradient-red-2 .icon-circle { color: #dc2626; }
        .bg-gradient-white .icon-circle { 
            background: rgba(239, 68, 68, 0.1); 
            color: #ef4444; 
            box-shadow: none;
        }
        .bg-gradient-white .label { color: #6b7280; }
        
        .badge-trend-up {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            padding: 0.2rem 0.5rem;
            border-radius: 50rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-right: 0.5rem;
            font-size: 0.75rem;
        }
        
        .badge-trend-up i { margin-right: 0.3rem; font-size: 0.75rem; }

        /* Soft Buttons */
        .btn-soft {
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            border-radius: 12px; /* rounded square instead of pill */
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            width: 100%;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }
        .btn-soft i { font-size: 1rem; }
        .btn-soft-primary { background: rgba(239, 68, 68, 0.08); color: #ef4444; }
        .btn-soft-primary:hover { background: rgba(239, 68, 68, 0.15); color: #dc2626; }

        /* Timeline */
        .timeline-modern {
            position: relative;
            padding: 0;
            margin: 0;
            list-style: none;
        }
        .timeline-modern::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 20px;
            width: 2px;
            background: #e5e7eb;
        }
        .timeline-modern li {
            position: relative;
            margin-bottom: 1rem;
            padding-left: 45px;
        }
        .timeline-modern li:last-child {
            margin-bottom: 0;
        }
        .timeline-modern li::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 6px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #ef4444;
            z-index: 1;
        }
        .timeline-modern .time {
            font-size: 0.8rem;
            color: #9ca3af;
            margin-bottom: 0.2rem;
            display: flex;
            align-items: center;
        }
        .timeline-modern .desc {
            display: block;
            color: #111827;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* Dark Mode Overrides */
        body.dark-mode {
            background-color: #454d55 !important;
        }
        body.dark-mode .card,
        body.dark-mode .main-header,
        body.dark-mode .main-sidebar,
        body.dark-mode .brand-link {
            background-color: #343a40 !important;
            border-color: #4b545c !important;
            color: #ffffff !important;
        }
        body.dark-mode .bg-gradient-white {
            background: #343a40 !important; /* Must use background to override linear-gradient */
            border-color: #4b545c !important;
            color: #ffffff !important;
        }
        body.dark-mode .bg-gradient-white .icon-circle {
            background-color: #4b545c !important;
            color: #ef4444 !important;
        }
        body.dark-mode .content-wrapper {
            background-color: #454d55 !important;
        }
        body.dark-mode h3, 
        body.dark-mode h4,
        body.dark-mode .card-title,
        body.dark-mode .timeline-modern .desc,
        body.dark-mode .bg-gradient-white .label {
            color: #ffffff !important;
        }
        body.dark-mode .timeline-modern::before {
            background: #4b545c !important;
        }
        body.dark-mode .btn-soft {
            background: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }
        body.dark-mode .btn-soft-primary {
            background: rgba(239, 68, 68, 0.15) !important;
            color: #f87171 !important;
        }
        body.dark-mode .btn-light {
            background: #4b545c !important;
            border-color: #6c757d !important;
            color: #ffffff !important;
        }
        body.dark-mode .btn-light .text-muted {
            color: #d1d5db !important;
        }
        body.dark-mode .timeline-modern .time {
            color: #adb5bd !important;
        }
        body.dark-mode .dropdown-menu {
            background-color: #343a40;
            color: #ffffff;
            border-color: #4b545c;
        }
        body.dark-mode .dropdown-item {
            color: #ffffff;
        }
        body.dark-mode .dropdown-item:hover {
            background-color: #4b545c;
        }
    </style>
    @yield('extra-css')
</head>
<body class="hold-transition sidebar-mini sidebar-no-expand layout-fixed">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Theme Toggle -->
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button" onclick="toggleTheme(event)">
                        <i class="fas fa-moon" id="theme-icon"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> {{ auth()->user()->nama_lengkap }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user"></i> Profil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog"></i> Pengaturan
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-danger elevation-0" style="border-right: none; box-shadow: none !important;">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/sman1ptk-logo.png') }}" alt="SMAN 1 PTK" style="max-height: 45px; width: auto; object-fit: contain;">
                <span class="brand-text">
                    <img src="{{ asset('images/logo.png') }}" alt="BRAGAS" style="max-height: 45px; width: auto; object-fit: contain;">
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar mt-3">
                
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Kelola Pengguna</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Data Pendaftar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('seleksi.index') }}" class="nav-link {{ request()->routeIs('seleksi.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard-check"></i>
                                    <p>Hasil Seleksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kriteria.index') }}" class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Set Seleksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profil.index') }}" class="nav-link {{ request()->routeIs('profil.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-info-circle"></i>
                                    <p>Profil Website</p>
                                </a>
                            </li>
                            
                            <!-- <li class="nav-header">KONTEN KEGIATAN</li> -->
                            <li class="nav-item">
                                <a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-bullhorn"></i>
                                    <p>Kelola Pengumuman</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('galeri.index') }}" class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>Galeri</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p>Berita</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>Jadwal</p>
                                </a>
                            </li>
                            
                            <!-- <li class="nav-header">SISTEM</li> -->
                            <li class="nav-item">
                                <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'pengurus')
                            <li class="nav-item">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Data Pendaftar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pendaftaran.verifikasi') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran.verifikasi') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-signature"></i>
                                    <p>Verifikasi Berkas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('seleksi.index') }}" class="nav-link {{ request()->routeIs('seleksi.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard-check"></i>
                                    <p>Input Hasil Seleksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pengumuman.index') }}" class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-bullhorn"></i>
                                    <p>Pengumuman Hasil</p>
                                </a>
                            </li>

                        @endif

                        @if(auth()->user()->role === 'calon_anggota')
                            <li class="nav-item">
                                <a href="{{ route('pendaftaran.index') }}" class="nav-link {{ request()->routeIs('pendaftaran.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Formulir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('status-seleksi.index') }}" class="nav-link {{ request()->routeIs('status-seleksi.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-check-circle"></i>
                                    <p>Status Seleksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data-pendaftar.index') }}" class="nav-link {{ request()->routeIs('data-pendaftar.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Data Pendaftar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pengumuman-seleksi.index') }}" class="nav-link {{ request()->routeIs('pengumuman-seleksi.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-bullhorn"></i>
                                    <p>Pengumuman</p>
                                </a>
                            </li>

                        @endif

                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST" id="sidebar-logout-form" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p class="text-danger font-weight-bold">Keluar</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @hasSection('page-title')
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 font-weight-bold" style="color: #111827;">@yield('page-title')</h1>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2026 <a href="#">Paskibra Ganesha</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/OverlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
    
    <script>
        function toggleTheme(e) {
            if(e) e.preventDefault();
            const body = document.body;
            const icon = document.getElementById('theme-icon');
            
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                if(icon) { icon.classList.remove('fa-sun'); icon.classList.add('fa-moon'); }
            } else {
                body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                if(icon) { icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); }
            }
        }
        
        $(window).on('load', function() {
            // Set initial icon
            const icon = document.getElementById('theme-icon');
            if (localStorage.getItem('theme') === 'dark' && icon) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }

            // Force disable AdminLTE's hover expand feature
            setTimeout(function() {
                $('.main-sidebar').off('mouseenter mouseleave');
                $('[data-widget="pushmenu"]').PushMenu('expandSidebarHover', false);
            }, 500);
        });
    </script>
    @yield('extra-js')
</body>
</html>
