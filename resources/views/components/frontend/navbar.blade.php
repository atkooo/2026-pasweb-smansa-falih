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
                    @auth
                    <div class="btn-group shadow-sm">
                        <a href="{{ route('dashboard') }}" class="btn btn-danger fw-bold d-flex align-items-center" style="background-color: #d10000; border: none; padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 6px 0 0 6px;">
                            <i class="fas fa-home me-2" style="font-size: 0.9em;"></i> DASHBOARD
                        </a>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split d-flex align-items-center justify-content-center" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #d10000; border: none; border-left: 1px solid rgba(255,255,255,0.3); border-radius: 0 6px 6px 0; padding: 0.5rem 0.6rem;">
                            <i class="fas fa-chevron-down" style="font-size: 0.7em;"></i>
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 0.5rem; min-width: 150px;">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item fw-semibold py-2 text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
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
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
