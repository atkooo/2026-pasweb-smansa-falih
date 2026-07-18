@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - Paskibra')

@section('page-title', 'Verifikasi Berkas')

@section('content')
<div class="mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Verifikasi Berkas</h3>
    <p class="text-muted" style="font-size: 0.95rem;">Periksa kelengkapan dan validasi berkas calon anggota.</p>
</div>

@if(session('success'))
    <x-alert type="success">
        {{ session('success') }}
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
        <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">MENUNGGU VERIFIKASI</h6>
        <form action="{{ route('admin.pendaftaran.verifikasi') }}" method="GET" class="form-inline">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Cari nama/NISN..." value="{{ request('search') }}" style="border-radius: 20px 0 0 20px;">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" style="border-radius: 0 20px 20px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="vertical-align: middle;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600;">#</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">NAMA LENGKAP</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600;">BERKAS</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600;">STATUS</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-right px-4" style="font-size: 0.85rem; font-weight: 600;">AKSI VERIFIKASI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $index => $p)
                    <tr>
                        <td class="px-4 py-3">{{ $pendaftarans->firstItem() + $index }}</td>
                        <td class="py-3 font-weight-bold">{{ $p->user->nama_lengkap ?? $p->nama_panggilan }}</td>
                        <td class="py-3 text-center">
                            <span class="badge badge-info px-2 py-1 text-white"><i class="fas fa-file-pdf"></i> 3/3 Berkas Lengkap</span>
                        </td>
                        <td class="py-3 text-center">
                            @if($p->status_pendaftaran == 'pending')
                                <span class="badge badge-warning px-3 py-2 rounded-pill text-white">Menunggu</span>
                            @elseif($p->status_pendaftaran == 'approved')
                                <span class="badge badge-success px-3 py-2 rounded-pill">Telah Diverifikasi</span>
                            @else
                                <span class="badge badge-danger px-3 py-2 rounded-pill">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <form action="{{ route('admin.pendaftaran.updateStatus', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menerima peserta ini?');">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_pendaftaran" value="approved">
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 font-weight-bold mr-1"><i class="fas fa-check"></i> Terima</button>
                            </form>
                            
                            <form action="{{ route('admin.pendaftaran.updateStatus', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak peserta ini?');">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_pendaftaran" value="rejected">
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 font-weight-bold"><i class="fas fa-times"></i> Tolak</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada berkas yang perlu diverifikasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pendaftarans->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $pendaftarans->links() }}
    </div>
    @endif
</div>
@endsection
