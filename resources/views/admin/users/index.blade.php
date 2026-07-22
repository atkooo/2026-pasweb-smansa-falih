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

@if(session('success'))
    <x-alert type="success">
        {{ session('success') }}
    </x-alert>
@endif

@if(session('error'))
    <x-alert type="danger">
        {{ session('error') }}
    </x-alert>
@endif

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
                                <option value="calon_anggota" {{ $user->role == 'calon_anggota' ? 'selected' : '' }}>Calon Anggota</option>
                                <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                                <option value="pengurus" {{ $user->role == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
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
    title="Tambah Pengguna Baru" 
    formAction="{{ route('users.store') }}" 
    submitLabel="Tambah Pengguna" 
    submitIcon="fas fa-plus"
>
    <div class="form-group">
        <label class="font-weight-600 text-muted small text-uppercase">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama_lengkap" class="form-control" required style="border-radius: 8px;" placeholder="Masukkan nama lengkap">
    </div>
    <div class="form-group">
        <label class="font-weight-600 text-muted small text-uppercase">NISN / Username <span class="text-danger">*</span></label>
        <input type="text" name="nisn" class="form-control" required style="border-radius: 8px;" placeholder="Masukkan NISN atau ID">
    </div>
    <div class="form-group">
        <label class="font-weight-600 text-muted small text-uppercase">Role (Hak Akses) <span class="text-danger">*</span></label>
        <select name="role" class="form-control" required style="border-radius: 8px;">
            <option value="calon_anggota">Calon Anggota</option>
            <option value="anggota">Anggota</option>
            <option value="pengurus">Pengurus</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group mb-0">
        <label class="font-weight-600 text-muted small text-uppercase">Password <span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" required style="border-radius: 8px;" placeholder="Minimal 6 karakter">
    </div>
</x-modal>
@endsection
