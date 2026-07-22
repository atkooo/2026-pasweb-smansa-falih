@extends('layouts.admin')

@section('title', 'Kelola Berita & Informasi - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Berita & Informasi</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Kelola pengumuman, berita, dan informasi kegiatan.</p>
    </div>
    <a href="{{ route('berita.create') }}" class="btn btn-primary shadow-sm px-4" style="border-radius: 10px; font-weight: 600;">
        <i class="fas fa-plus mr-2"></i> Tulis Berita
    </a>
</div>



<div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 border-bottom-0 text-muted px-4" style="font-size: 0.85rem; font-weight: 600; width: 5%;">NO</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600; width: 35%;">JUDUL BERITA</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600; width: 15%;">KATEGORI</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600; width: 15%;">STATUS</th>
                        <th class="border-top-0 border-bottom-0 text-muted" style="font-size: 0.85rem; font-weight: 600; width: 15%;">TANGGAL</th>
                        <th class="border-top-0 border-bottom-0 text-muted text-center" style="font-size: 0.85rem; font-weight: 600; width: 15%;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritas as $index => $berita)
                    <tr>
                        <td class="px-4 text-muted font-weight-bold">{{ $beritas->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center py-2">
                                @if($berita->gambar_sampul)
                                    <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="Sampul" class="rounded mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="rounded mr-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark">{{ Str::limit($berita->judul, 50) }}</h6>
                                    <small class="text-muted"><a href="{{ route('berita.show', $berita->slug) }}" target="_blank" class="text-muted"><i class="fas fa-external-link-alt mr-1"></i>Lihat Publik</a></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-pill badge-light text-primary border" style="font-weight: 500; px-3 py-2">{{ $berita->kategori }}</span>
                        </td>
                        <td>
                            @if($berita->status == 'diterbitkan')
                                <span class="badge badge-pill badge-success-soft text-success px-3 py-2" style="background-color: #d1fae5; font-weight: 600;"><i class="fas fa-check-circle mr-1"></i> Diterbitkan</span>
                            @else
                                <span class="badge badge-pill badge-warning-soft text-warning px-3 py-2" style="background-color: #fef3c7; font-weight: 600;"><i class="fas fa-edit mr-1"></i> Draf</span>
                            @endif
                        </td>
                        <td class="text-muted" style="font-size: 0.9rem;">
                            {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d M Y') }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-sm btn-light text-primary mr-1" data-toggle="tooltip" title="Edit" style="border-radius: 8px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" data-toggle="tooltip" title="Hapus" style="border-radius: 8px;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-3"><i class="far fa-newspaper fa-3x" style="opacity: 0.4;"></i></div>
                            <h6 class="font-weight-bold text-dark">Belum ada berita</h6>
                            <p class="text-muted mb-3">Mulai publikasikan informasi, berita, atau pengumuman pertama Anda.</p>
                            <a href="{{ route('berita.create') }}" class="btn btn-sm btn-primary px-4" style="border-radius: 8px;"><i class="fas fa-plus mr-2"></i>Tulis Berita</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($beritas->hasPages())
    <div class="d-flex justify-content-center">
        {{ $beritas->links() }}
    </div>
@endif

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush
@endsection
