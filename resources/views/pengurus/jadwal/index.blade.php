@extends('layouts.admin')

@section('title', 'Jadwal Kegiatan')

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
    
    .icon-box {
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background: rgba(59, 130, 246, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
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
    body.dark-mode .icon-box {
        background: #374151;
        color: #60a5fa;
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
        border-color: #3b82f6;
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
        <h3 class="font-weight-bold" style="letter-spacing: -0.5px; margin-bottom: 0.2rem;">Jadwal Kegiatan</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Manajemen agenda dan jadwal latihan rutin Paskibra.</p>
    </div>
    <div>
        <button class="btn px-4 py-2" style="background-color: #3b82f6; color: white; border-radius: 50rem; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); font-weight: 600;" data-toggle="modal" data-target="#modal-add">
            <i class="fas fa-plus mr-2"></i> Tambah Jadwal
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Tanggal & Waktu</th>
                <th>Tempat</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $jadwal)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="icon-box">
                            <i class="far fa-calendar-alt text-lg"></i>
                        </div>
                        <div>
                            <span class="d-block font-weight-bold">{{ $jadwal->nama_kegiatan }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="d-block text-dark font-weight-medium">{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d M Y') }}</span>
                    <span class="text-muted" style="font-size: 0.85rem;"><i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</span>
                </td>
                <td>
                    <span class="text-muted"><i class="fas fa-map-marker-alt mr-1"></i> {{ $jadwal->tempat }}</span>
                </td>
                <td class="text-right">
                    <button class="btn btn-sm btn-soft btn-soft-primary mr-1" onclick="editJadwal({{ $jadwal->id }}, '{{ addslashes($jadwal->nama_kegiatan) }}', '{{ $jadwal->tanggal_kegiatan }}', '{{ $jadwal->waktu }}', '{{ addslashes($jadwal->tempat) }}')">
                        <i class="fas fa-pen"></i>
                    </button>
                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-soft" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4 text-muted">Belum ada jadwal kegiatan yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $jadwals->links() }}
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 1rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold">Tambah Jadwal Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Tanggal</label>
                            <input type="date" name="tanggal_kegiatan" class="form-control" style="border-radius: 0.5rem;" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Waktu</label>
                            <input type="time" name="waktu" class="form-control" style="border-radius: 0.5rem;" required>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Tempat</label>
                        <input type="text" name="tempat" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" style="border-radius: 0.5rem;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn px-4" style="background-color: #3b82f6; color: white; border-radius: 0.5rem; font-weight: 600;">Simpan</button>
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
                    <h5 class="modal-title font-weight-bold">Edit Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="edit-nama" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Tanggal</label>
                            <input type="date" name="tanggal_kegiatan" id="edit-tanggal" class="form-control" style="border-radius: 0.5rem;" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Waktu</label>
                            <input type="time" name="waktu" id="edit-waktu" class="form-control" style="border-radius: 0.5rem;" required>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Tempat</label>
                        <input type="text" name="tempat" id="edit-tempat" class="form-control" style="border-radius: 0.5rem;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" style="border-radius: 0.5rem;" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn px-4" style="background-color: #3b82f6; color: white; border-radius: 0.5rem; font-weight: 600;">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    function editJadwal(id, nama, tanggal, waktu, tempat) {
        document.getElementById('edit-form').action = '/jadwal/' + id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-tanggal').value = tanggal;
        
        // Extract only HH:MM from time string if it contains seconds
        if (waktu.length > 5) {
            waktu = waktu.substring(0, 5);
        }
        document.getElementById('edit-waktu').value = waktu;
        
        document.getElementById('edit-tempat').value = tempat;
        
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
