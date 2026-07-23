@extends('layouts.auth')

@section('title', 'Daftar Calon Anggota - Paskibra Ganesha')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-card">

            <div class="auth-image-side auth-bg-register position-relative">
                <div style="position: absolute; top: -50px; right: -50px; width: 220px; height: 220px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -60px; left: -60px; width: 260px; height: 260px; background: radial-gradient(circle, rgba(0,0,0,0.25) 0%, transparent 70%); border-radius: 50%;"></div>

                <div class="auth-image-content">
                    <span class="role-badge role-badge-white mb-3 d-inline-block shadow-sm">PENERIMAAN ANGGOTA</span>
                    <h3 class="fw-bold mb-3 text-white">Langkah Awal Anda!</h3>
                    <p class="mb-4 text-white" style="font-size: 0.95rem; opacity: 0.9; line-height: 1.7; font-weight: 300;">
                        Bergabunglah bersama keluarga besar Paskibra SMA Negeri 1 Pontianak dan ukir sejarah prestasi serta kepemimpinan Anda.
                    </p>
                    <div class="pt-3 border-top border-white-10 d-flex align-items-center gap-2" style="font-size: 0.85rem; color: rgba(255,255,255,0.8);">
                        <i class="fas fa-shield-alt text-white"></i>
                        <span>Paskibra SMA Negeri 1 Pontianak</span>
                    </div>
                </div>
            </div>

            <div class="auth-form-side">
                <div class="text-center mb-2">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo" style="width: 42px; margin-bottom: 0.3rem;">
                    <h2 class="auth-title">Daftar Akun</h2>
                    <p class="auth-subtitle mb-0">Lengkapi formulir di bawah untuk mendaftar</p>
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

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-2">
                        <label for="nama_lengkap" class="form-label fw-bold mb-1" style="font-size: 0.82rem; color: #444;">Nama Lengkap</label>
                        <div class="position-relative form-group">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                class="form-control form-control-custom @error('nama_lengkap') is-invalid @enderror"
                                placeholder="Nama lengkap"
                                required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback-custom">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- NISN -->
                    <div class="mb-2">
                        <label for="nisn" class="form-label fw-bold mb-1" style="font-size: 0.82rem; color: #444;">NISN</label>
                        <div class="position-relative form-group">
                            <i class="fas fa-barcode input-icon"></i>
                            <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}"
                                class="form-control form-control-custom @error('nisn') is-invalid @enderror"
                                placeholder="NISN"
                                required>
                            @error('nisn')
                                <div class="invalid-feedback-custom">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-2">
                        <!-- Password -->
                        <div class="col-md-6 mb-2">
                            <label for="password" class="form-label fw-bold mb-1" style="font-size: 0.82rem; color: #444;">Password</label>
                            <div class="position-relative form-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-custom @error('password') is-invalid @enderror"
                                    placeholder="Password"
                                    required>
                                <i class="fas fa-eye toggle-password"
                                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a0a0a0; transition: color 0.3s ease; z-index: 10;"
                                    onclick="togglePassword('password', this)"></i>
                                @error('password')
                                    <div class="invalid-feedback-custom">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-2">
                            <label for="password_confirmation" class="form-label fw-bold mb-1" style="font-size: 0.82rem; color: #444;">Ulangi Password</label>
                            <div class="position-relative form-group">
                                <i class="fas fa-check-circle input-icon"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control form-control-custom @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Ulangi password"
                                    required>
                                <i class="fas fa-eye toggle-password"
                                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a0a0a0; transition: color 0.3s ease; z-index: 10;"
                                    onclick="togglePassword('password_confirmation', this)"></i>
                                @error('password_confirmation')
                                    <div class="invalid-feedback-custom">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 p-2 rounded" style="background-color: #fff5f5; border: 1px dashed #ffc9c9;">
                        <p class="mb-0 text-muted" style="font-size: 0.73rem; line-height: 1.4;">
                            <i class="fas fa-info-circle text-danger me-1"></i> Dengan mendaftar, Anda menyetujui seluruh ketentuan seleksi Paskibra Ganesha.
                        </p>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-auth text-white mb-2">
                        <i class="fas fa-user-plus me-2"></i> DAFTAR SEKARANG
                    </button>

                    <div class="text-center mt-2">
                        <p class="text-muted mb-1" style="font-size: 0.83rem;">
                            Sudah punya akun? <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Masuk di sini</a>
                        </p>
                        <a href="{{ url('/') }}" class="text-secondary text-decoration-none fw-semibold" style="font-size: 0.83rem;">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection