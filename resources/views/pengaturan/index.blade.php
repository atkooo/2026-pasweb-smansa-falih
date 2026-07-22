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

                <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h6 class="font-weight-bold mb-3 text-secondary border-bottom pb-2">Foto Profil & KTA</h6>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            @if($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="rounded-circle shadow border" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto text-primary font-weight-bold" style="width: 100px; height: 100px; font-size: 2.5rem;">
                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="form-group mb-1">
                                <label class="font-weight-600 text-muted small text-uppercase">Unggah Foto Resmi (Untuk KTA & Profile)</label>
                                <input type="file" name="foto" class="form-control-file" accept="image/*" style="font-size: 0.9rem;">
                            </div>
                            <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal 2MB. Foto ini akan otomatis digunakan pada Kartu Tanda Anggota (KTA).</small>
                        </div>
                    </div>

                    <h6 class="font-weight-bold mb-3 text-secondary border-bottom pb-2">Informasi Pribadi</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required style="border-radius: 8px;">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="font-weight-600 text-muted small text-uppercase">NISN / NIP / Username Login</label>
                                <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $user->nisn) }}" required style="border-radius: 8px;">
                            </div>
                        </div>
                    </div>

                    <h6 class="font-weight-bold mb-3 mt-4 text-secondary border-bottom pb-2">Ubah Kata Sandi</h6>
                    <p class="text-muted small mb-3">Kosongkan bagian ini jika Anda tidak ingin mengubah kata sandi.</p>
                    
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
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
