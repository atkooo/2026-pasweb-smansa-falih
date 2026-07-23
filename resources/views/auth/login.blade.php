@extends('layouts.auth')

@section('title', 'Login - Paskibra Ganesha')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-card">

            <!-- Side Banner (Colored Gradient Background) -->
            <div class="auth-image-side auth-bg-login position-relative">
                <div style="position: absolute; top: -50px; right: -50px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -60px; left: -60px; width: 260px; height: 260px; background: radial-gradient(circle, rgba(0,0,0,0.25) 0%, transparent 70%); border-radius: 50%;"></div>

                <div class="auth-image-content">
                    <span class="role-badge role-badge-white mb-3 d-inline-block shadow-sm">SISTEM INFORMASI</span>
                    <h3 class="fw-bold mb-3 text-white">Selamat Datang Kembali!</h3>
                    <p class="mb-4 text-white" style="font-size: 0.95rem; opacity: 0.9; line-height: 1.7; font-weight: 300;">
                        Silakan masuk untuk mengakses Dashboard keanggotaan dan sistem informasi seleksi Paskibra SMA Negeri 1 Pontianak.
                    </p>
                    <div class="pt-3 border-top border-white-10 d-flex align-items-center gap-2" style="font-size: 0.85rem; color: rgba(255,255,255,0.8);">
                        <i class="fas fa-shield-alt text-white"></i>
                        <span>Paskibra SMA Negeri 1 Pontianak</span>
                    </div>
                </div>
            </div>

            <!-- Form Side -->
            <div class="auth-form-side">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo" style="width: 55px; margin-bottom: 0.5rem;">
                    <h2 class="auth-title">Masuk Akun</h2>
                    <p class="auth-subtitle mb-0">Masukkan NISN / NIP dan password Anda</p>
                </div>

                @if(session('error') || $errors->any())
                    <div class="auth-alert-danger d-flex align-items-center justify-content-between mb-3 shadow-xs alert alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-exclamation-triangle text-danger fs-6 shrink-0"></i>
                            <span>{{ session('error') ?? $errors->first() }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" style="padding: 1rem;"></button>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <!-- NISN / NIP Input -->
                    <div class="mb-3">
                        <label for="nisn" class="form-label fw-bold mb-1" style="font-size: 0.85rem; color: #444;">NISN / NIP</label>
                        <div class="position-relative form-group">
                            <i class="fas fa-id-card input-icon"></i>
                            <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}"
                                class="form-control form-control-custom @error('nisn') is-invalid @enderror"
                                placeholder="NISN / NIP"
                                required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold mb-1" style="font-size: 0.85rem; color: #444;">Password</label>
                        <div class="position-relative form-group mt-1">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password"
                                class="form-control form-control-custom @error('password') is-invalid @enderror"
                                placeholder="Password"
                                required>
                            <i class="fas fa-eye toggle-password"
                                style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a0a0a0; transition: color 0.3s ease; z-index: 10;"
                                onclick="togglePassword('password', this)"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check mb-0">
                            <input type="checkbox" class="form-check-input" id="remember" style="cursor: pointer;">
                            <label class="form-check-label text-muted" for="remember"
                                style="font-size: 0.85rem; cursor: pointer;">Ingat saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-auth text-white mt-1">
                        MASUK <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-2" style="font-size: 0.85rem;">
                            Belum punya akun? <a href="{{ route('register') }}"
                                class="text-danger fw-bold text-decoration-none">Daftar sekarang</a>
                        </p>
                        <a href="{{ url('/') }}" class="text-secondary text-decoration-none fw-semibold"
                            style="font-size: 0.85rem;"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection