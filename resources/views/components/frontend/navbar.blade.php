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
                    <a href="{{ route('galeri') }}" class="nav-link {{ request()->routeIs('galeri*') ? 'active' : '' }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jadwal') }}" class="nav-link {{ request()->routeIs('jadwal*') ? 'active' : '' }}">Jadwal</a>
                </li>
                <li class="nav-item ms-lg-3 my-2 my-lg-0 d-flex align-items-center gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-danger fw-bold rounded-pill px-3 py-2 text-white" style="background-color: #d10000; border: none; font-size: 0.85rem;">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger fw-bold rounded-pill px-3 py-2" style="font-size: 0.85rem;">
                                <i class="fas fa-sign-out-alt me-1"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-danger fw-bold rounded-pill px-3 py-2 me-1" style="font-size: 0.85rem;">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-danger fw-bold rounded-pill px-3 py-2 text-white" style="background-color: #d10000; border: none; font-size: 0.85rem;">
                            Daftar
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
