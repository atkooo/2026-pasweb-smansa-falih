@extends(auth()->check() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Galeri Paskibra - Paskibra Ganesha')

@section('content')
<div class="{{ auth()->check() ? 'mt-2 mb-4' : 'container py-3' }}">
    <div class="{{ auth()->check() ? 'mb-4' : 'text-center mb-5 mx-auto' }}" style="{{ auth()->check() ? '' : 'max-width: 800px;' }}">
        <h2 class="font-weight-bold mb-3 {{ auth()->check() ? 'text-dark' : 'section-title' }}">GALERI</h2>
        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.7; font-weight: 400;">Mengabadikan setiap momen perjuangan, kebersamaan, dan prestasi Paskibra sebagai bagian dari perjalanan, dedikasi, dan kebanggaan yang akan selalu dikenang.</p>
    </div>

    @if($albums->isEmpty())
        <div class="text-center py-5">
            <div class="text-muted mb-3"><i class="fas fa-camera fa-4x" style="opacity: 0.2;"></i></div>
            <h5 class="text-muted">Belum ada foto di dalam galeri saat ini.</h5>
        </div>
    @else
        <!-- Modern Album Grid Style -->
        <div class="row g-4">
            @foreach($albums as $album)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('galeri.show', urlencode($album->judul_foto)) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 gallery-card">
                        <div class="card-img-wrapper">
                            <img src="{{ asset('storage/' . $album->cover_photo) }}" class="card-img-top gallery-img-public" alt="{{ $album->judul_foto }}">
                            <div class="img-overlay">
                                <span class="photo-count-badge">
                                    <i class="far fa-images mr-1"></i> {{ $album->photo_count }} Foto
                                </span>
                            </div>
                        </div>
                        <div class="card-body bg-white p-4 d-flex flex-column">
                            <h5 class="card-title font-weight-bold mb-3 text-dark album-title">{{ $album->judul_foto }}</h5>
                            
                            <div class="mt-auto d-flex align-items-center album-meta">
                                <div class="meta-icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <span class="meta-date">
                                    {{ $album->tanggal_pelaksanaan ? \Carbon\Carbon::parse($album->tanggal_pelaksanaan)->translatedFormat('d F Y') : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-5">
            {{ $albums->links() }}
        </div>
    @endif
</div>

<style>
    /* Section Title Gradient */
    .section-title {
        background: linear-gradient(135deg, #d32f2f 0%, #ff5252 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 0.3em;
        font-size: 2.8rem;
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

    /* Card Styling */
    .gallery-card {
        border-radius: 24px !important;
        transition: box-shadow 0.3s ease;
        background-color: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04) !important;
        overflow: hidden;
    }
    .gallery-card:hover {
        box-shadow: 0 15px 35px rgba(211,47,47,0.08) !important;
    }

    /* Image Wrapper & Overlay */
    .card-img-wrapper {
        height: 220px;
        position: relative;
        overflow: hidden;
    }
    .gallery-img-public {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .img-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
        display: flex;
        justify-content: flex-end;
    }

    /* Badges & Meta */
    .photo-count-badge {
        background: rgba(255, 255, 255, 0.95);
        color: #d32f2f;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        backdrop-filter: blur(5px);
    }
    
    .album-title {
        font-size: 1.25rem;
        line-height: 1.5;
        transition: color 0.3s ease;
    }
    .gallery-card:hover .album-title {
        color: #d32f2f !important;
    }

    .album-meta {
        color: #6c757d;
    }
    .meta-icon {
        background: #fdf2f2;
        color: #d32f2f;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .gallery-card:hover .meta-icon {
        background: #d32f2f;
        color: #fff;
    }
    .meta-date {
        font-size: 0.95rem;
        font-weight: 500;
    }
    
    .pagination {
        margin-bottom: 0;
    }
</style>
@endsection
