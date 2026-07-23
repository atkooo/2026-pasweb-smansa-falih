@extends('layouts.admin')

@section('title', 'Pengaturan Akun - Paskibra Ganesha')

@section('page-title', 'Pengaturan Akun')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="fas fa-user-edit mr-2 text-primary"></i> Edit Profil & Keamanan
                </h6>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger" style="border-radius: 8px;">
                        <ul class="mb-0 pl-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Terpisah Khusus Auto-Upload Foto Profil -->
                <form id="avatarUploadForm" action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="d-none">
                    @csrf
                    <input type="file" id="avatarFileInput" name="foto" accept="image/*" onchange="document.getElementById('avatarUploadForm').submit();">
                </form>

                <!-- Form Hapus Foto Profil -->
                <form id="hapusFotoSettingsForm" action="{{ route('pengaturan.hapusFoto') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <h6 class="font-weight-bold mb-3 text-secondary border-bottom pb-2">Foto Profil & Avatar</h6>
                <div class="row align-items-center mb-4">
                    <div class="col-md-12 text-center">
                        <div class="position-relative d-inline-block">
                            @if($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="rounded-circle shadow border" style="width: 110px; height: 110px; object-fit: cover; border: 4px solid #ef4444 !important; cursor: pointer;" onclick="document.getElementById('avatarFileInput').click();" title="Klik foto profil untuk mengganti">
                                
                                <!-- Tombol Ganti Foto (Kamera) -->
                                <div class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="bottom: 2px; right: 2px; width: 32px; height: 32px; border: 2px solid white; cursor: pointer;" onclick="document.getElementById('avatarFileInput').click();" title="Pilih Foto Baru">
                                    <i class="fas fa-camera" style="font-size: 0.85rem;"></i>
                                </div>
                                <!-- Tombol Hapus Foto (Sampah) -->
                                <div class="position-absolute bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="bottom: 2px; left: 2px; width: 32px; height: 32px; border: 2px solid white; cursor: pointer;" onclick="if(confirm('Apakah Anda yakin ingin menghapus foto profil ini?')) document.getElementById('hapusFotoSettingsForm').submit();" title="Hapus Foto Profil">
                                    <i class="fas fa-trash-alt" style="font-size: 0.85rem;"></i>
                                </div>
                            @else
                                <div class="rounded-circle bg-danger text-white border d-flex align-items-center justify-content-center mx-auto font-weight-bold shadow" style="width: 110px; height: 110px; font-size: 2.8rem; cursor: pointer;" onclick="document.getElementById('avatarFileInput').click();" title="Klik untuk memilih foto profil">
                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                </div>
                                <div class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="bottom: 2px; right: 2px; width: 32px; height: 32px; border: 2px solid white; cursor: pointer;" onclick="document.getElementById('avatarFileInput').click();" title="Pilih Foto Profil">
                                    <i class="fas fa-camera" style="font-size: 0.85rem;"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <form action="{{ route('pengaturan.update') }}" method="POST">
                    @csrf
                    
                    <h6 class="font-weight-bold mb-3 text-secondary border-bottom pb-2">Informasi Akun</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">Nama Lengkap</label>
                                @if(in_array($user->role, ['admin', 'pengurus']))
                                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required style="border-radius: 8px;">
                                @else
                                    <input type="text" class="form-control bg-light" value="{{ $user->nama_lengkap }}" readonly style="border-radius: 8px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">NISN / NIP / ID Login</label>
                                @if(in_array($user->role, ['admin', 'pengurus']))
                                    <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $user->nisn) }}" required style="border-radius: 8px;">
                                @else
                                    <input type="text" class="form-control bg-light" value="{{ $user->nisn }}" readonly style="border-radius: 8px;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold mb-3 mt-4 text-secondary border-bottom pb-2">Ubah Kata Sandi</h6>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">Kata Sandi Saat Ini</label>
                                <input type="password" name="password_lama" class="form-control" style="border-radius: 8px;" placeholder="Masukkan kata sandi lama Anda">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">Kata Sandi Baru</label>
                                <input type="password" name="password_baru" class="form-control" style="border-radius: 8px;" placeholder="Minimal 8 karakter">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_baru_confirmation" class="form-control" style="border-radius: 8px;" placeholder="Ulangi kata sandi baru">
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-4">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 8px;">
                            <i class="fas fa-save mr-2"></i> Simpan Password Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
