@extends('layouts.app')

@section('title', 'Berita & Informasi - Paskibra Ganesha')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold" style="color: #111827; letter-spacing: -1px;">Berita & Informasi</h2>
        <p class="text-muted text-lg">Kabar terbaru, pengumuman, dan kegiatan seputar Paskibra Ganesha.</p>
    </div>

    <div class="row">
        @forelse($beritas as $berita)
        <div class="col-md-4 mb-4">
            <div class="card h-100" style="border: none; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; transition: transform 0.3s; display: flex; flex-direction: column;">
                @if($berita->gambar_sampul)
                    <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                @else
                    <div style="height: 200px; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                        <i class="fas fa-newspaper fa-3x"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444; border-radius: 50rem; font-weight: 600;">
                            {{ $berita->kategori }}
                        </span>
                        <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i> {{ $berita->created_at->format('d M Y') }}</small>
                    </div>
                    <h5 class="card-title font-weight-bold mb-3" style="line-height: 1.4;">
                        <a href="{{ route('berita.show', $berita->slug) }}" style="color: #1f2937; text-decoration: none;">{{ Str::limit($berita->judul, 60) }}</a>
                    </h5>
                    <p class="card-text text-muted mb-4" style="font-size: 0.95rem;">
                        {{ Str::limit(strip_tags($berita->isi), 100) }}
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="font-weight-bold" style="color: #ef4444; text-decoration: none;">Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted mb-3"><i class="fas fa-folder-open fa-4x" style="opacity: 0.2;"></i></div>
            <h5 class="text-muted">Belum ada berita atau informasi yang dipublikasikan.</h5>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $beritas->links() }}
    </div>
</div>
@endsection
