@extends('layouts.admin')

@section('title', 'Kelola Pengumuman - Paskibra')



@section('content')
<div class="mb-4 mt-2">
    <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Pengumuman Hasil</h3>
    <p class="text-muted" style="font-size: 0.95rem;">Kelola pengumuman kelulusan dan informasi penting lainnya.</p>
</div>

<div class="card shadow-sm border-0" style="border-radius: 0.75rem;">
    <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
        <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">DAFTAR PENGUMUMAN</h6>
        <a href="{{ route('pengumuman.create') }}" class="btn btn-primary btn-sm rounded-pill px-3"><i class="fas fa-plus mr-1"></i> Buat Pengumuman</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="vertical-align: middle;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600;">#</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">JUDUL PENGUMUMAN</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600;">TANGGAL PUBLIKASI</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600;">STATUS</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-right px-4" style="font-size: 0.85rem; font-weight: 600;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumumans as $index => $p)
                    <tr>
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="py-3 font-weight-bold">
                            {{ $p->judul }}<br>
                            <span class="badge badge-info">{{ $p->jenis }}</span>
                            @if($p->lampiran)
                                <a href="{{ Storage::url($p->lampiran) }}" target="_blank" class="badge badge-secondary"><i class="fas fa-paperclip"></i> Ada Lampiran</a>
                            @endif
                        </td>
                        <td class="py-3 text-muted">{{ $p->created_at->format('d M Y') }}</td>
                        <td class="py-3 text-center">
                            <span class="badge badge-success px-3 py-2 rounded-pill text-white">Dipublikasi</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('pengumuman.edit', $p->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 font-weight-bold"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('pengumuman.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 font-weight-bold"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada pengumuman yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
