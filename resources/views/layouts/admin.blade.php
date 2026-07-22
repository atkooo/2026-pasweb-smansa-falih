<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title', 'Dashboard - Paskibra Ganesha')</title>
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.3.0/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/daterangepicker/3.1/daterangepicker.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
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
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                        role="button" data-toggle="dropdown">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                alt="{{ auth()->user()->nama_lengkap }}" class="rounded-circle mr-2"
                                style="width: 25px; height: 25px; object-fit: cover;">
                        @else
                            <i class="fas fa-user-circle mr-1"></i>
                        @endif
                        {{ auth()->user()->nama_lengkap }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profil-pengguna.index') }}">
                            <i class="fas fa-user"></i> Profil
                        </a>
                        <a class="dropdown-item" href="{{ route('pengaturan.index') }}">
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
        <aside class="main-sidebar sidebar-light-danger elevation-0"
            style="border-right: none; box-shadow: none !important;">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/sman1ptk-logo.png') }}" alt="SMAN 1 PTK"
                    style="max-height: 45px; width: auto; object-fit: contain;">
                <span class="brand-text">
                    <img src="{{ asset('images/logo.webp') }}" alt="BRAGAS"
                        style="max-height: 45px; width: auto; object-fit: contain;">
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar mt-3">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if(auth()->user()->role === 'admin')
                            <!-- SISTEM & PROFIL -->
                            <li
                                class="nav-item {{ request()->routeIs('users.*', 'profil.*', 'admin.pengaturan-sistem.*') ? 'menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('users.*', 'profil.*', 'admin.pengaturan-sistem.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Sistem & Profil
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}"
                                            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Kelola Pengguna</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pengaturan-sistem.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.pengaturan-sistem.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Pengaturan Pendaftaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('profil.index', ['tab' => 'beranda']) }}"
                                            class="nav-link {{ request()->routeIs('profil.*') && request('tab', 'beranda') === 'beranda' ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Pengaturan Beranda</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('profil.index', ['tab' => 'sejarah']) }}"
                                            class="nav-link {{ request()->routeIs('profil.*') && request('tab') === 'sejarah' ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Sejarah & Visi Misi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('profil.index', ['tab' => 'struktur']) }}"
                                            class="nav-link {{ request()->routeIs('profil.*') && request('tab') === 'struktur' ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Struktur Organisasi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('profil.index', ['tab' => 'pendaftaran']) }}"
                                            class="nav-link {{ request()->routeIs('profil.*') && request('tab') === 'pendaftaran' ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Atur Pendaftaran</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- PENERIMAAN ANGGOTA -->
                            <li
                                class="nav-item {{ request()->routeIs('kriteria.*', 'admin.pendaftaran.*', 'seleksi.*') ? 'menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('kriteria.*', 'admin.pendaftaran.*', 'seleksi.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Penerimaan Anggota
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('kriteria.index') }}"
                                            class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Set Kriteria Seleksi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pendaftaran.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.pendaftaran.index') || request()->routeIs('admin.pendaftaran.show') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Data Pendaftar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('seleksi.index') }}"
                                            class="nav-link {{ request()->routeIs('seleksi.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Hasil Seleksi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- KONTEN & INFORMASI -->
                            <li
                                class="nav-item {{ request()->routeIs('berita.*', 'pengumuman.*', 'jadwal.*', 'galeri.*') ? 'menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('berita.*', 'pengumuman.*', 'jadwal.*', 'galeri.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p>
                                        Konten & Informasi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('berita.index') }}"
                                            class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Berita</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pengumuman.index') }}"
                                            class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Pengumuman</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jadwal.index') }}"
                                            class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Jadwal Kegiatan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('galeri.index') }}"
                                            class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Galeri Foto</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- LAPORAN -->
                            <li class="nav-item">
                                <a href="{{ route('laporan.index') }}"
                                    class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'pengurus')
                            <li
                                class="nav-item {{ request()->routeIs('admin.pendaftaran.*', 'seleksi.*', 'pengumuman.*') ? 'menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.pendaftaran.*', 'seleksi.*', 'pengumuman.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Penerimaan Anggota
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pendaftaran.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.pendaftaran.index') || request()->routeIs('admin.pendaftaran.show') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Data Pendaftar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('seleksi.index') }}"
                                            class="nav-link {{ request()->routeIs('seleksi.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Input Hasil Seleksi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pengumuman.index') }}"
                                            class="nav-link {{ request()->routeIs('pengumuman.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Pengumuman Hasil</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'anggota')
                            <li class="nav-item">
                                <a href="{{ route('jadwal') }}"
                                    class="nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>Jadwal Kegiatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('berita') }}"
                                    class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p>Berita & Informasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('galeri') }}"
                                    class="nav-link {{ request()->routeIs('galeri*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-images"></i>
                                    <p>Galeri Foto</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profil-pengguna.index') }}"
                                    class="nav-link {{ request()->routeIs('profil-pengguna.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Profil Saya</p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role === 'calon_anggota')
                            <li
                                class="nav-item {{ request()->routeIs('pendaftaran.*', 'status-seleksi.*', 'pengumuman-seleksi.*') ? 'menu-is-opening menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('pendaftaran.*', 'status-seleksi.*', 'pengumuman-seleksi.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>
                                        Tahapan Seleksi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('pendaftaran.index') }}"
                                            class="nav-link {{ request()->routeIs('pendaftaran.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Formulir Pendaftaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('status-seleksi.index') }}"
                                            class="nav-link {{ request()->routeIs('status-seleksi.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Status Kelulusan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pengumuman-seleksi.index') }}"
                                            class="nav-link {{ request()->routeIs('pengumuman-seleksi.*') ? 'active' : '' }}">
                                            <i class="fas fa-minus nav-icon"></i>
                                            <p>Pengumuman</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data-pendaftar.index') }}"
                                    class="nav-link {{ request()->routeIs('data-pendaftar.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Daftar Peserta</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item mt-4">
                            <form action="{{ route('logout') }}" method="POST" id="sidebar-logout-form"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
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
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

    <script>
        function toggleTheme(e) {
            if (e) e.preventDefault();
            const body = document.body;
            const icon = document.getElementById('theme-icon');

            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                if (icon) { icon.classList.remove('fa-sun'); icon.classList.add('fa-moon'); }
            } else {
                body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                if (icon) { icon.classList.remove('fa-moon'); icon.classList.add('fa-sun'); }
            }
        }

        $(window).on('load', function () {
            // Set initial icon
            const icon = document.getElementById('theme-icon');
            if (localStorage.getItem('theme') === 'dark' && icon) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }

            // Force disable AdminLTE's hover expand feature
            setTimeout(function () {
                $('.main-sidebar').off('mouseenter mouseleave');
            }, 500);
        });
    </script>
    @yield('extra-js')
</body>

</html>