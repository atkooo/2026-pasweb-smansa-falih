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
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 1rem; border: none;">
                                <div class="modal-header border-bottom-0 pb-0">
                                    <h5 class="modal-title font-weight-bold" id="modalEditLabel{{ $user->id }}">Edit Pengguna</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
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
                                                <option value="pengurus" {{ $user->role == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="font-weight-600 text-muted small text-uppercase">Password Baru <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" style="border-radius: 8px;">
                                            <small class="text-muted mt-1 d-block">Minimal 6 karakter.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 pt-0">
                                        <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px; font-weight: 500;">Batal</button>
                                        <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 600;">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; border: none;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title font-weight-bold" id="modalTambahLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-600 text-muted small text-uppercase">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required style="border-radius: 8px;" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600 text-muted small text-uppercase">NISN / Username</label>
                        <input type="text" name="nisn" class="form-control" required style="border-radius: 8px;" placeholder="Masukkan NISN atau ID">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-600 text-muted small text-uppercase">Role (Hak Akses)</label>
                        <select name="role" class="form-control" required style="border-radius: 8px;">
                            <option value="calon_anggota">Calon Anggota</option>
                            <option value="pengurus">Pengurus</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-600 text-muted small text-uppercase">Password</label>
                        <input type="password" name="password" class="form-control" required style="border-radius: 8px;" placeholder="Minimal 6 karakter">
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px; font-weight: 500;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 600;">Tambah Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
