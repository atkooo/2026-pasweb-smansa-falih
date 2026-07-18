@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('extra-css')
<style>
    .table-custom {
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }
    .table-custom tr {
        background-color: white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        border-radius: 0.5rem;
        transition: transform 0.2s;
    }
    .table-custom tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .table-custom td, .table-custom th {
        border: none;
        padding: 1rem 1.2rem;
        vertical-align: middle;
    }
    .table-custom th {
        background: transparent;
        font-weight: 600;
        color: #6b7280;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table-custom td:first-child, .table-custom th:first-child {
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }
    .table-custom td:last-child, .table-custom th:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }
    .badge-role {
        padding: 0.4rem 0.8rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-admin { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .badge-pengurus { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .badge-calon { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4b5563;
        font-weight: bold;
        margin-right: 1rem;
    }

    body.dark-mode .table-custom tr {
        background-color: #1f2937;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    body.dark-mode .table-custom th {
        color: #9ca3af;
    }
    body.dark-mode .table-custom td {
        color: #e5e7eb;
    }
    body.dark-mode .avatar-circle {
        background: #374151;
        color: #e5e7eb;
    }
    body.dark-mode .modal-content {
        background-color: #1f2937;
        color: #f9fafb;
        border-color: #374151;
    }
    body.dark-mode .modal-header, body.dark-mode .modal-footer {
        border-color: #374151;
    }
    body.dark-mode .form-control {
        background-color: #374151;
        border-color: #4b5563;
        color: #f9fafb;
    }
    body.dark-mode .form-control:focus {
        border-color: #ef4444;
        background-color: #374151;
        color: #f9fafb;
    }
    body.dark-mode .close {
        color: #f9fafb;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold" style="color: #111827; letter-spacing: -0.5px; margin-bottom: 0.2rem;">Kelola Pengguna</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Manajemen akun panitia, pengurus, dan calon anggota.</p>
    </div>
    <div>
        <button class="btn px-4 py-2" style="background-color: #ef4444; color: white; border-radius: 50rem; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); font-weight: 600;" data-toggle="modal" data-target="#modal-add">
            <i class="fas fa-plus mr-2"></i> Tambah Pengguna
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>NISN / Username</th>
                <th>Role</th>
                <th>Terdaftar Pada</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                        </div>
                        <div>
                            <span class="d-block font-weight-bold">{{ $user->nama_lengkap }}</span>
                        </div>
                    </div>
                </td>
                <td><span class="text-muted">{{ $user->nisn }}</span></td>
                <td>
                    @if($user->role === 'admin')
                        <span class="badge-role badge-admin">Admin</span>
                    @elseif($user->role === 'pengurus')
                        <span class="badge-role badge-pengurus">Pengurus</span>
                    @else
                        <span class="badge-role badge-calon">Calon Anggota</span>
                    @endif
                </td>
                <td><span class="text-muted">{{ $user->created_at->format('d M Y') }}</span></td>
                <td class="text-right">
                    <button class="btn btn-sm btn-soft btn-soft-primary mr-1" onclick="editUser({{ $user->id }}, '{{ addslashes($user->nama_lengkap) }}', '{{ addslashes($user->nisn) }}', '{{ $user->role }}')">
                        <i class="fas fa-pen"></i>
                    </button>
                    @if($user->id !== auth()->id())
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-soft" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 1rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold">Tambah Pengguna Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">NISN / Username</label>
                        <input type="text" name="nisn" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Role</label>
                        <select name="role" class="form-control" style="border-radius: 0.5rem;" required>
                            <option value="calon_anggota">Calon Anggota</option>
                            <option value="pengurus">Pengurus</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" style="border-radius: 0.5rem;" required minlength="6">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" style="border-radius: 0.5rem;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn px-4" style="background-color: #ef4444; color: white; border-radius: 0.5rem; font-weight: 600;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 1rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold">Edit Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="edit-nama" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">NISN / Username</label>
                        <input type="text" name="nisn" id="edit-nisn" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Role</label>
                        <select name="role" id="edit-role" class="form-control" style="border-radius: 0.5rem;" required>
                            <option value="calon_anggota">Calon Anggota</option>
                            <option value="pengurus">Pengurus</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control" style="border-radius: 0.5rem;" minlength="6" placeholder="Biarkan kosong jika tidak ingin mengubah">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" style="border-radius: 0.5rem;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn px-4" style="background-color: #ef4444; color: white; border-radius: 0.5rem; font-weight: 600;">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    function editUser(id, nama, nisn, role) {
        document.getElementById('edit-form').action = '/users/' + id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-nisn').value = nisn;
        document.getElementById('edit-role').value = role;
        
        $('#modal-edit').modal('show');
    }

    // Display validation errors if any
    @if($errors->any())
        let errorMsg = "";
        @foreach ($errors->all() as $error)
            errorMsg += "{{ $error }}\n";
        @endforeach
        alert(errorMsg);
    @endif
</script>
@endsection
