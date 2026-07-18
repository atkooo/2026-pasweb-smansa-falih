@extends('layouts.admin')

@section('title', 'Input Hasil Seleksi - Paskibra')

@section('content')
<div class="mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Input Hasil Seleksi</h3>
    <p class="text-muted" style="font-size: 0.95rem;">Masukkan nilai dan status kelulusan peserta yang telah disetujui.</p>
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
        <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">DATA SELEKSI AKHIR</h6>
        <form action="{{ route('seleksi.index') }}" method="GET" class="form-inline">
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
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">NO</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">NAMA & NO PESERTA</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">ASAL WILAYAH</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">TINGGI BADAN</th>
                        @foreach($kriterias as $k)
                            <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">{{ strtoupper($k->nama) }} ({{ $k->bobot }}%)</th>
                        @endforeach
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">NILAI AKHIR</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-right px-4" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesertas as $index => $p)
                    <tr>
                        <td class="px-4 py-3 align-middle">{{ $pesertas->firstItem() + $index }}</td>
                        <td class="py-3 align-middle">
                            <div class="font-weight-bold text-dark" style="font-size: 0.95rem;">{{ strtoupper($p->user->nama_lengkap ?? $p->nama_panggilan) }}</div>
                            <div class="text-primary" style="font-size: 0.85rem;">{{ $p->user->nisn ?? $p->id }}</div>
                        </td>
                        <td class="py-3 align-middle text-muted" style="font-size: 0.9rem;">{{ strtoupper($p->asal_sekolah) }}</td>
                        <td class="py-3 align-middle text-center text-muted">{{ $p->tinggi_badan ?? '-' }}</td>
                        
                        @foreach($kriterias as $k)
                            <td class="py-3 align-middle text-center text-muted">
                                {{ isset($p->nilai_kriteria[$k->id]) && $p->nilai_kriteria[$k->id] > 0 ? rtrim(rtrim(number_format($p->nilai_kriteria[$k->id], 14, '.', ''), '0'), '.') : '0' }}
                            </td>
                        @endforeach

                        <td class="py-3 align-middle text-center">
                            <span class="font-weight-bold text-primary" style="font-size: 0.95rem;">{{ number_format($p->nilai_akhir, 2) }}</span>
                        </td>
                        <td class="px-4 py-3 align-middle text-right">
                            <a href="{{ route('seleksi.show', $p->id) }}" class="btn btn-sm btn-info text-white" title="Input Nilai">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">Belum ada peserta yang disetujui untuk diseleksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pesertas->hasPages())
    <div class="card-footer bg-white border-top">
        {{ $pesertas->links() }}
    </div>
    @endif
</div>
@endsection
