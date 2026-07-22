@extends('layouts.auth')

@section('title', 'Daftar Calon Anggota - Paskibra Ganesha')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-card">

            <!-- Image Side -->
            <div class="auth-image-side auth-bg-register">
                <div class="auth-image-content">
                    <span class="role-badge role-badge-white mb-2 d-inline-block">PENERIMAAN ANGGOTA</span>
                    <h3 class="fw-bold mb-2">Langkah Awal Anda!</h3>
                    <p class="mb-0 text-light" style="font-size: 0.95rem; opacity: 0.9;">
                        Bergabunglah bersama keluarga besar Paskibra SMA Negeri 1 Pontianak dan ukir sejarah prestasi Anda.
                    </p>
                </div>
            </div>

            <!-- Form Side -->
            <div class="auth-form-side">
                <div class="text-center mb-2">
                    <img src="{{ asset('images/logo.webp') }}" alt="Logo" style="width: 45px; margin-bottom: 0.3rem;">
                    <h2 class="auth-title">Daftar Akun</h2>
                    <p class="auth-subtitle">Lengkapi formulir di bawah untuk mendaftar</p>
                </div>

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

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        @if($errors->any())
                            Swal.fire({
                                icon: 'error',
                                title: 'Pendaftaran gagal',
                                text: 'Silakan periksa kembali form yang Anda kirimkan.',
                                confirmButtonText: 'Tutup'
                            });
                        @endif
                    });
                </script>

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-2">
                        <label for="nama_lengkap" class="form-label fw-bold mb-1"
                            style="font-size: 0.8rem; color: #444;">Nama Lengkap</label>
                        <div class="position-relative form-group">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                class="form-control form-control-custom @error('nama_lengkap') is-invalid @enderror"
                                placeholder="Contoh: Budi Santoso" required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- NISN -->
                    <div class="mb-2">
                        <label for="nisn" class="form-label fw-bold mb-1" style="font-size: 0.8rem; color: #444;">NISN <span
                                class="text-muted fw-normal">(10 digit)</span></label>
                        <div class="position-relative form-group">
                            <i class="fas fa-barcode input-icon"></i>
                            <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}"
                                class="form-control form-control-custom @error('nisn') is-invalid @enderror"
                                placeholder="Contoh: 1234567890" required>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-2">
                        <!-- Password -->
                        <div class="col-md-6 mb-2">
                            <label for="password" class="form-label fw-bold mb-1"
                                style="font-size: 0.8rem; color: #444;">Password</label>
                            <div class="position-relative form-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-custom @error('password') is-invalid @enderror"
                                    placeholder="Min. 8 karakter" required>
                                <i class="fas fa-eye toggle-password"
                                    style="position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a0a0a0; transition: color 0.3s ease; z-index: 10;"
                                    onclick="togglePassword('password', this)"></i>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-2">
                            <label for="password_confirmation" class="form-label fw-bold mb-1"
                                style="font-size: 0.8rem; color: #444;">Ulangi Password</label>
                            <div class="position-relative form-group">
                                <i class="fas fa-check-circle input-icon"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control form-control-custom @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Ulangi password" required>
                                <i class="fas fa-eye toggle-password"
                                    style="position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a0a0a0; transition: color 0.3s ease; z-index: 10;"
                                    onclick="togglePassword('password_confirmation', this)"></i>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-1 p-2 rounded" style="background-color: #fff5f5; border: 1px dashed #ffc9c9;">
                        <p class="mb-0 text-muted" style="font-size: 0.7rem; line-height: 1.3;">
                            <i class="fas fa-info-circle text-danger me-1"></i> Dengan mendaftar, Anda menyetujui seluruh
                            ketentuan seleksi Paskibra Ganesha.
                        </p>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-auth text-white mb-2">
                        <i class="fas fa-user-plus me-2"></i> DAFTAR SEKARANG
                    </button>

                    <div class="text-center mt-2">
                        <p class="text-muted mb-1" style="font-size: 0.8rem;">
                            Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-danger fw-bold text-decoration-none">Masuk di sini</a>
                        </p>
                        <a href="{{ url('/') }}" class="text-secondary text-decoration-none fw"
                            style="font-size: 0.85rem;"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection