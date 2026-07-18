@extends('layouts.auth')

@section('title', 'Login - Paskibra Ganesha')

@section('content')
<style>
    body {
        background-color: #f4f6f9;
    }
    
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
    }

    .auth-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        width: 100%;
        max-width: 900px;
        display: flex;
        flex-direction: row;
        max-height: 90vh; /* Prevent it from being taller than screen */
    }

    .auth-image-side {
        width: 45%;
        background: url('{{ asset("images/fotoawal.png") }}') center center / cover no-repeat;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2rem;
        color: white;
    }

    .auth-image-side::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(209, 0, 0, 0.2), rgba(0, 0, 0, 0.8));
        z-index: 1;
    }

    .auth-image-content {
        position: relative;
        z-index: 2;
    }

    .auth-form-side {
        width: 55%;
        padding: 2.5rem 3rem;
        background-color: #ffffff;
        overflow-y: auto; /* allow scrolling if content still overflows on small heights */
    }

    .auth-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 0.2rem;
    }

    .auth-subtitle {
        color: #6c757d;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .form-control-custom {
        border: 2px solid #eee;
        border-radius: 10px;
        padding: 0.6rem 1rem 0.6rem 2.8rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #fafbfc;
    }

    .form-control-custom:focus {
        border-color: #d10000;
        box-shadow: 0 0 0 4px rgba(209, 0, 0, 0.1);
        background-color: #fff;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a0a0;
        transition: color 0.3s ease;
    }

    .form-group:focus-within .input-icon {
        color: #d10000;
    }

    .btn-auth {
        background-color: #d10000;
        border: none;
        border-radius: 12px;
        padding: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-auth:hover {
        background-color: #a30000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(209, 0, 0, 0.2);
    }

    .role-badge {
        font-size: 0.75rem;
        padding: 0.3em 0.8em;
        background-color: #f8d7da;
        color: #d10000;
        border-radius: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .auth-card {
            flex-direction: column;
        }
        .auth-image-side {
            width: 100%;
            padding: 2rem;
            min-height: 250px;
        }
        .auth-form-side {
            width: 100%;
            padding: 2.5rem 1.5rem;
        }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        
        <!-- Image Side -->
        <div class="auth-image-side">
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
                            placeholder="Contoh: 199305052023211016"
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
