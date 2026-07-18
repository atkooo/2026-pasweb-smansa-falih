<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Paskibra Ganesha')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        html, body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            width: 100%;
        }
        body {
            padding-top: 80px;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #ffffff;
            padding-top: 0;
            padding-bottom: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
            color: #000 !important;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand i {
            font-size: 2rem;
        }

        .nav-item {
            margin: 0 !important;
        }

        .nav-link {
            color: #000 !important;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            padding: 1rem 1.2rem !important;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #d10000 !important;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu {
            border: none;
            border-radius: 0 0 0.5rem 0.5rem;
            background-color: #ffffff;
            padding: 0;
            margin: 0;
            min-width: 200px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #333 !important;
            padding: 0.8rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
            font-weight: 600;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #d10000 !important;
        }
        
        .dropdown-item.active-menu {
            color: #d10000 !important;
            font-weight: 800;
        }

        @media all and (min-width: 992px) {
            .navbar .nav-item.dropdown:hover .dropdown-menu,
            .navbar .btn-group:hover .dropdown-menu {
                display: block;
                margin-top: 0 !important;
                top: 100%;
            }

            .navbar .nav-item.dropdown:hover>.nav-link {
                color: #d10000 !important;
            }
        }

        /* Main Content */
        main {
            min-height: 600px;
        }

        /* Footer */
        footer {
            background-color: #f4f4f4;
            color: #333;
            padding: 4rem 0 2rem 0;
            margin-top: 5rem;
            font-size: 0.9rem;
        }

        .footer-logo-text {
            font-size: 1.25rem;
            letter-spacing: 1px;
            color: #000;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .social-link i {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }
        .social-link:hover {
            color: #d10000 !important;
            transform: translateX(5px);
        }

        /* Alerts */
        .alert {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Buttons */
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        /* Section Titles */
        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #dc3545;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top py-1">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Paskibra" width="40" height="40" class="me-2">
                <div style="line-height: 1.1;">
                    <div style="font-size: 1.1rem; letter-spacing: 0.5px; font-weight: 900; color: #000;">PASKIBRA GANESHA</div>
                    <div style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.5px; color: #555;">SMA NEGERI 1 PONTIANAK</div>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: #000; font-size: 1.5rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('sejarah') || request()->routeIs('visi-misi') || request()->routeIs('struktur-organisasi') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">Tentang <i class="fas fa-chevron-down ms-1" style="font-size: 0.7em;"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ request()->routeIs('sejarah') ? 'active-menu' : '' }}" href="{{ route('sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('visi-misi') ? 'active-menu' : '' }}" href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('struktur-organisasi') ? 'active-menu' : '' }}" href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('galeri') }}" class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwal') }}" class="nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}">Jadwal</a>
                    </li>
                    <li class="nav-item ms-lg-3 my-2 my-lg-0 d-flex align-items-center">
                        <div class="btn-group shadow-sm">
                            <a href="{{ route('login') }}" class="btn btn-danger fw-bold d-flex align-items-center" style="background-color: #d10000; border: none; padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 6px 0 0 6px;">
                                MASUK
                            </a>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split d-flex align-items-center justify-content-center" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #d10000; border: none; border-left: 1px solid rgba(255,255,255,0.3); border-radius: 0 6px 6px 0; padding: 0.5rem 0.6rem;">
                                <i class="fas fa-chevron-down" style="font-size: 0.7em;"></i>
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 0.5rem; min-width: 150px;">
                                <li><a class="dropdown-item fw-semibold py-2" href="{{ route('register') }}">Daftar</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('hero')

        <div class="container-lg mt-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container-lg">
            <div class="row mb-4">
                <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Paskibra" width="65" height="65" class="me-3">
                        <span class="footer-logo-text fw-black" style="font-weight: 900;">PASKIBRA GANESHA</span>
                    </div>
                    <p style="color: #333; max-width: 350px; font-size: 0.95rem; line-height: 1.6;">Platform Resmi Informasi dan Seleksi Penerimaan Anggota Pasukan Pengibar Bendera</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="fw-bold mb-4" style="font-size: 1.1rem; color: #000;">Media Sosial</h6>
                    <ul class="list-unstyled d-flex flex-column gap-3" style="color: #444; font-weight: 500;">
                        <li><a href="https://www.instagram.com/bragas_sman1ptk?igsh=MWwzbzNhdzhzOW5oeA==" target="_blank" rel="noopener noreferrer" class="text-decoration-none social-link" style="color: #555;"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="https://www.tiktok.com/@paskibraganesha?_r=1&_t=ZS-97fPekDQ656" target="_blank" rel="noopener noreferrer" class="text-decoration-none social-link" style="color: #555;"><i class="fab fa-tiktok"></i> Tiktok</a></li>
                        <li><a href="https://wa.me/6285753702222" target="_blank" rel="noopener noreferrer" class="text-decoration-none social-link" style="color: #555;"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-4" style="font-size: 1.1rem; color: #000;">Alamat</h6>
                    <div class="d-flex" style="color: #444; line-height: 1.7; font-weight: 500;">
                        <i class="fas fa-map-marker-alt mt-1 me-3" style="font-size: 1.2rem; color: #d10000;"></i>
                        <p class="mb-0" style="max-width: 300px;">
                            Jl. Gusti Johan Idrus,<br>
                            Kelurahan Akcaya, Kecamatan<br>
                            Pontianak Selatan, Kota Pontianak,<br>
                            Kalimantan Barat
                        </p>
                    </div>
                </div>
            </div>
            <hr class="mb-3 mt-4" style="border-top: 1px solid #000; opacity: 1;">
            <div style="font-size: 0.95rem; color: #333;">
                <div class="fw-bold mb-1">Paskibra SMA Negeri 1 Pontianak</div>
                <div style="color: #555;">&copy; 2026 Paskibra Ganesha. All rights reserved.</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>