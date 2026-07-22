@extends('layouts.admin')

@section('title', 'Kelola Pengguna - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Kelola Pengguna</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Kelola data pengurus, admin, dan calon anggota.</p>
    </div>
    <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-plus mr-2"></i> Tambah Pengguna
    </button>
</div>



@if($errors->any())
    <x-alert type="danger">
        <ul class="mb-0 pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
    <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">DAFTAR PENGGUNA</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="vertical-align: middle;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600;">NO</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">NAMA LENGKAP</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">NISN/ID</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">HAK AKSES</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-right px-4" style="font-size: 0.85rem; font-weight: 600;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td class="px-4 py-3 align-middle">{{ $index + 1 }}</td>
                        <td class="py-3 align-middle font-weight-bold text-dark">{{ $user->nama_lengkap }}</td>
                        <td class="py-3 align-middle text-muted">{{ $user->nisn }}</td>
                        <td class="py-3 align-middle">
                            @if($user->role === 'admin')
                                <span class="badge badge-danger px-3 py-2 rounded-pill">Admin</span>
                            @elseif($user->role === 'pengurus')
                                <span class="badge badge-primary px-3 py-2 rounded-pill">Pengurus</span>
                            @elseif($user->role === 'anggota')
                                <span class="badge badge-success px-3 py-2 rounded-pill">Anggota</span>
                            @else
                                <span class="badge badge-info px-3 py-2 rounded-pill text-white">Calon Anggota</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 align-middle text-right">
                            <button type="button" class="btn btn-sm btn-light text-info rounded-circle mr-1" data-toggle="modal" data-target="#modalDetail{{ $user->id }}" title="Lihat Detail Informasi User/Anggota">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-light text-primary rounded-circle mr-1" data-toggle="modal" data-target="#modalEdit{{ $user->id }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Detail Pengguna / Anggota -->
                    <x-modal 
                        id="modalDetail{{ $user->id }}" 
                        title="Detail Informasi Pengguna / Anggota" 
                        submitLabel="Tutup" 
                        submitIcon="fas fa-times"
                    >
                        <div class="text-center pb-3 border-bottom mb-3">
                            @if($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama_lengkap }}" class="rounded-circle shadow border mb-2" style="width: 85px; height: 85px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto text-primary font-weight-bold mb-2" style="width: 85px; height: 85px; font-size: 2.2rem;">
                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                </div>
                            @endif
                            <h5 class="font-weight-bold text-dark mb-1">{{ $user->nama_lengkap }}</h5>
                            <div>
                                @if($user->role === 'admin')
                                    <span class="badge badge-danger px-3 py-1 rounded-pill">Administrator</span>
                                @elseif($user->role === 'pengurus')
                                    <span class="badge badge-primary px-3 py-1 rounded-pill">Pengurus Paskibra</span>
                                @elseif($user->role === 'anggota')
                                    <span class="badge badge-success px-3 py-1 rounded-pill"><i class="fas fa-check-circle mr-1"></i> Anggota Resmi Paskibra</span>
                                @else
                                    <span class="badge badge-info px-3 py-1 rounded-pill text-white">Calon Anggota</span>
                                @endif
                            </div>
                        </div>

                        <div class="row text-left">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block font-weight-bold text-uppercase">NISN / Username Login</small>
                                <span class="text-dark font-weight-bold" style="font-size: 1rem;">{{ $user->nisn ?? '-' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block font-weight-bold text-uppercase">No. KTA Digital</small>
                                <span class="text-warning font-weight-bold" style="font-size: 1rem;">KTA-{{ $user->formulirPendaftaran->tahun_periode ?? date('Y') }}/00{{ $user->id }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block font-weight-bold text-uppercase">Asal Sekolah</small>
                                <span class="text-dark">{{ $user->formulirPendaftaran->asal_sekolah ?? 'SMA Negeri 1 Pontianak' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block font-weight-bold text-uppercase">Angkatan / Periode</small>
                                <span class="text-dark">Tahun {{ $user->formulirPendaftaran->tahun_periode ?? date('Y') }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block font-weight-bold text-uppercase">Kontak (No HP)</small>
                                <span class="text-dark">{{ $user->formulirPendaftaran->no_hp ?? '-' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block font-weight-bold text-uppercase">Terdaftar Sejak</small>
                                <span class="text-dark">{{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</span>
                            </div>
                            @if($user->formulirPendaftaran)
                            <div class="col-12 mb-2">
                                <small class="text-muted d-block font-weight-bold text-uppercase">Alamat Rumah</small>
                                <span class="text-dark">{{ $user->formulirPendaftaran->alamat ?? '-' }}</span>
                            </div>
                            <div class="col-12 mt-2 pt-2 border-top">
                                <small class="text-muted d-block font-weight-bold text-uppercase mb-1">Motivasi / Catatan</small>
                                <p class="text-dark bg-light p-2 rounded mb-0 small">{{ $user->formulirPendaftaran->motivasi ?? '-' }}</p>
                            </div>
                            @endif
                        </div>
                    </x-modal>

                    <!-- Modal Edit -->
                    <x-modal 
                        id="modalEdit{{ $user->id }}" 
                        title="Edit Pengguna" 
                        formAction="{{ route('users.update', $user->id) }}" 
                        method="PUT"
                        submitLabel="Simpan Perubahan" 
                        submitIcon="fas fa-save"
                    >
                        <div class="form-group">
                            <label class="font-weight-600 text-muted small text-uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}" required style="border-radius: 8px;">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-600 text-muted small text-uppercase">NISN / Username</label>
                            <input type="text" name="nisn" class="form-control" value="{{ $user->nisn }}" required style="border-radius: 8px;">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-600 text-muted small text-uppercase">Role (Hak Akses)</label>
                            <select name="role" class="form-control" required style="border-radius: 8px;">
                                <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota Paskibra (Anggota Resmi / KTA Aktif)</option>
                                <option value="calon_anggota" {{ $user->role == 'calon_anggota' ? 'selected' : '' }}>Calon Anggota (Belum Seleksi)</option>
                                <option value="pengurus" {{ $user->role == 'pengurus' ? 'selected' : '' }}>Pengurus Paskibra</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                            </select>
                            <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle text-info mr-1"></i> Memilih <strong>Anggota Paskibra</strong> akan otomatis mengaktifkan status Anggota & KTA Digital.</small>
                        </div>
                        <div class="form-group mb-0">
                            <label class="font-weight-600 text-muted small text-uppercase">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" style="border-radius: 8px;">
                            <small class="text-muted mt-1 d-block">Minimal 6 karakter.</small>
                        </div>
                    </x-modal>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<x-modal 
    id="modalTambah" 
    title="Tambah Pengguna / Anggota Baru" 
    formAction="{{ route('users.store') }}" 
    submitLabel="Tambah Pengguna / Anggota" 
    submitIcon="fas fa-user-plus"
>
    <div class="form-group">
        <label class="font-weight-600 text-muted small text-uppercase">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama_lengkap" class="form-control" required style="border-radius: 8px;" placeholder="Masukkan nama lengkap">
    </div>
    <div class="form-group">
        <label class="font-weight-600 text-muted small text-uppercase">NISN / Username Login <span class="text-danger">*</span></label>
        <input type="text" name="nisn" class="form-control" required style="border-radius: 8px;" placeholder="Masukkan NISN atau ID Login">
    </div>
    <div class="form-group">
        <label class="font-weight-600 text-muted small text-uppercase">Role (Hak Akses) <span class="text-danger">*</span></label>
        <select name="role" class="form-control" required style="border-radius: 8px;">
            <option value="anggota">Anggota Paskibra (Anggota Resmi / KTA Aktif)</option>
            <option value="calon_anggota">Calon Anggota (Belum Seleksi)</option>
            <option value="pengurus">Pengurus Paskibra</option>
            <option value="admin">Administrator</option>
        </select>
        <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle text-info mr-1"></i> Memilih <strong>Anggota Paskibra</strong> akan membuatkan akun Anggota Resmi yang langsung siap mencetak KTA Digital.</small>
    </div>
    <div class="form-group mb-0">
        <label class="font-weight-600 text-muted small text-uppercase">Password <span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" required style="border-radius: 8px;" placeholder="Minimal 6 karakter">
    </div>
</x-modal>
@endsection
