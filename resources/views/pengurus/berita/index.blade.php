@extends('layouts.admin')

@section('title', 'Berita & Informasi')

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
    .badge-status {
        padding: 0.4rem 0.8rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-diterbitkan { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .badge-draf { background: rgba(107, 114, 128, 0.1); color: #6b7280; }
    
    .thumbnail-img {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 0.25rem;
    }
    .thumbnail-placeholder {
        width: 60px;
        height: 40px;
        background: #f3f4f6;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
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
    body.dark-mode .thumbnail-placeholder {
        background: #374151;
        color: #6b7280;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold" style="letter-spacing: -0.5px; margin-bottom: 0.2rem;">Berita & Informasi</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola pengumuman, berita, dan kegiatan paskibra.</p>
    </div>
    <div>
        <a href="{{ route('berita.create') }}" class="btn px-4 py-2" style="background-color: #ef4444; color: white; border-radius: 50rem; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); font-weight: 600;">
            <i class="fas fa-plus mr-2"></i> Tulis Berita
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th>Sampul</th>
                <th>Judul & Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th class="text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $berita)
            <tr>
                <td>
                    @if($berita->gambar_sampul)
                        <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="Sampul" class="thumbnail-img">
                    @else
                        <div class="thumbnail-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </td>
                <td>
                    <span class="d-block font-weight-bold">{{ Str::limit($berita->judul, 40) }}</span>
                    <span class="text-muted" style="font-size: 0.85rem;"><i class="fas fa-tag mr-1"></i> {{ $berita->kategori }}</span>
                </td>
                <td>
                    @if($berita->status === 'diterbitkan')
                        <span class="badge-status badge-diterbitkan">Diterbitkan</span>
                    @else
                        <span class="badge-status badge-draf">Draf</span>
                    @endif
                </td>
                <td><span class="text-muted">{{ $berita->created_at->format('d M Y') }}</span></td>
                <td class="text-right">
                    <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-sm btn-soft btn-soft-primary mr-1">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
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
                <td colspan="5" class="text-center py-4 text-muted">Belum ada berita yang ditulis.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $beritas->links() }}
</div>
@endsection
