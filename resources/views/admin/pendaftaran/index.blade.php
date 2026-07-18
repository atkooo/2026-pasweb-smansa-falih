@extends('layouts.admin')

@section('title', 'Data Pendaftar - Paskibra')

@section('content')
<div class="mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Data Pendaftar</h3>
    <p class="text-muted" style="font-size: 0.95rem;">Lihat dan kelola seluruh calon anggota yang telah mendaftar.</p>
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
        <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">DAFTAR CALON ANGGOTA</h6>
        <form action="{{ route('admin.pendaftaran.index') }}" method="GET" class="form-inline">
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
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">ASAL SEKOLAH</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">TANGGAL DAFTAR</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600;">STATUS</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-right px-4" style="font-size: 0.85rem; font-weight: 600;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $index => $p)
                    <tr>
                        <td class="px-4 py-3">{{ $pendaftarans->firstItem() + $index }}</td>
                        <td class="py-3 font-weight-bold">{{ $p->user->nama_lengkap ?? $p->nama_panggilan }}</td>
                        <td class="py-3 text-muted">{{ $p->asal_sekolah }}</td>
                        <td class="py-3 text-muted">{{ $p->created_at->format('d M Y') }}</td>
                        <td class="py-3 text-center">
                            @if($p->status_pendaftaran == 'pending')
                                <span class="badge badge-warning px-3 py-2 rounded-pill text-white">Pending</span>
                            @elseif($p->status_pendaftaran == 'approved')
                                <span class="badge badge-success px-3 py-2 rounded-pill">Disetujui</span>
                            @else
                                <span class="badge badge-danger px-3 py-2 rounded-pill">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 font-weight-bold">Detail</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data pendaftar.</td>
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
