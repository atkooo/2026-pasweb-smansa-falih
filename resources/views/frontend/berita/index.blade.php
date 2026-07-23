@extends(auth()->check() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Berita & Informasi - Paskibra Ganesha')

@section('content')
<div class="{{ auth()->check() ? 'mt-2 mb-4' : 'container py-3' }}">
    <div class="{{ auth()->check() ? 'mb-4' : 'text-center mb-5 mx-auto' }}" style="{{ auth()->check() ? '' : 'max-width: 800px;' }}">
        <h2 class="font-weight-bold mb-3 {{ auth()->check() ? 'text-dark' : 'section-title' }}">BERITA & INFORMASI</h2>
        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.7; font-weight: 400;">
            Kabar terbaru, pengumuman resmi, dan dokumentasi kegiatan seputar Paskibra Ganesha SMA Negeri 1 Pontianak.
        </p>
    </div>

    <div class="row g-4">
        @forelse($beritas as $berita)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 news-card">
                <div class="card-img-wrapper">
                    @if($berita->gambar_sampul)
                        <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" class="card-img-top news-img" alt="{{ $berita->judul }}">
                    @else
                        <div class="news-img-placeholder">
                            <i class="fas fa-newspaper fa-3x" style="color: #d10000; opacity: 0.3;"></i>
                        </div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge news-badge">
                            {{ $berita->kategori }}
                        </span>
                        <small class="text-muted"><i class="far fa-calendar-alt me-1 text-danger"></i> {{ $berita->created_at->format('d M Y') }}</small>
                    </div>
                    <h5 class="card-title fw-bold mb-3" style="line-height: 1.4; font-size: 1.15rem;">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="news-title-link">{{ Str::limit($berita->judul, 60) }}</a>
                    </h5>
                    <p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                        {{ Str::limit(strip_tags($berita->isi), 100) }}
                    </p>
                    <div class="mt-auto pt-2 border-top border-light d-flex justify-content-between align-items-center">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="fw-bold text-danger text-decoration-none d-inline-flex align-items-center gap-1" style="font-size: 0.9rem;">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right small ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="card border-0 p-5 shadow-sm mx-auto" style="max-width: 600px; border-radius: 1.25rem; background: #ffffff;">
                <div class="text-muted mb-3"><i class="fas fa-newspaper fa-4x" style="color: #d10000; opacity: 0.3;"></i></div>
                <h5 class="fw-bold text-dark mb-2">Belum Ada Berita</h5>
                <p class="text-muted mb-0">Belum ada berita atau informasi yang dipublikasikan saat ini. Silakan periksa kembali nanti.</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links() }}
    </div>
</div>

<style>
    /* Section Title Gradient */
    .section-title {
        background: linear-gradient(135deg, #d32f2f 0%, #ff5252 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 0.2em;
        font-size: 2.6rem;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #d32f2f 0%, #ff5252 100%);
        border-radius: 2px;
    }

    .news-card {
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
        background: #ffffff;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(209, 0, 0, 0.12) !important;
    }

    .card-img-wrapper {
        height: 210px;
        position: relative;
        overflow: hidden;
        background-color: #f8f9fa;
    }
    .news-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .news-card:hover .news-img {
        transform: scale(1.06);
    }
    .news-img-placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #fff0f0 0%, #ffe6e6 100%);
    }

    .news-badge {
        background-color: rgba(209, 0, 0, 0.08);
        color: #d10000;
        border-radius: 50rem;
        font-weight: 700;
        padding: 0.4em 0.9em;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .news-title-link {
        color: #1f2937;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .news-title-link:hover {
        color: #d10000;
    }
</style>
@endsection
