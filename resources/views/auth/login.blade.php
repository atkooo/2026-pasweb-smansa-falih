@extends('layouts.auth')

@section('title', 'Login - Paskibra Ganesha')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        
        <!-- Image Side -->
        <div class="auth-image-side auth-bg-login">
            <div class="auth-image-content">
                <span class="role-badge mb-2 d-inline-block">SISTEM INFORMASI</span>
                <h3 class="fw-bold mb-2">Selamat Datang Kembali!</h3>
                <p class="mb-0 text-light" style="font-size: 0.95rem; opacity: 0.9;">
                    Silakan masuk untuk mengakses dasbor keanggotaan Paskibra SMA Negeri 1 Pontianak.
                </p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-form-side">
            <div class="text-center mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px; margin-bottom: 0.5rem;">
                <h2 class="auth-title">Masuk Akun</h2>
                <p class="auth-subtitle">Masukkan NISN/NIP dan password Anda</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" style="border-radius: 10px;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 10px;" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0 px-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <!-- NISN Input -->
                <div class="mb-3">
                    <label for="nisn" class="form-label fw-bold mb-1" style="font-size: 0.85rem; color: #444;">NISN / NIP</label>
                    <div class="position-relative form-group">
                        <i class="fas fa-id-card input-icon"></i>
                        <input 
                            type="text" 
                            id="nisn" 
                            name="nisn" 
                            value="{{ old('nisn') }}" 
                            class="form-control form-control-custom @error('nisn') is-invalid @enderror" 
                            placeholder="Contoh: 1234567890"
                            required
                        >
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold mb-1" style="font-size: 0.85rem; color: #444;">Password</label>
                    <div class="position-relative form-group mt-1">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control form-control-custom @error('password') is-invalid @enderror" 
                            placeholder="••••••••"
                            required
                        >
                        <i class="fas fa-eye toggle-password" style="position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a0a0a0; transition: color 0.3s ease; z-index: 10;" onclick="togglePassword('password', this)"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check mb-0">
                        <input type="checkbox" class="form-check-input" id="remember" style="cursor: pointer;">
                        <label class="form-check-label text-muted" for="remember" style="font-size: 0.85rem; cursor: pointer;">Ingat Saya</label>
                    </div>
                    <a href="#" class="text-danger text-decoration-none" style="font-size: 0.8rem; font-weight: 600;">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-auth text-white mt-1">
                    MASUK <i class="fas fa-arrow-right ms-2"></i>
                </button>
                
                <div class="text-center mt-3">
                    <p class="text-muted mb-1" style="font-size: 0.85rem;">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Daftar sekarang</a>
                    </p>
                    <a href="{{ url('/') }}" class="text-secondary text-decoration-none fw" style="font-size: 0.85rem;"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                </div>
            </form>
            

            
        </div>
    </div>
</div>
@endsection

