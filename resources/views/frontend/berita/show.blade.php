@extends(auth()->check() ? 'layouts.admin' : 'layouts.app')

@section('title', $berita->judul . ' - Paskibra Ganesha')

@section('content')
<div class="{{ auth()->check() ? 'mt-2 mb-4' : 'container py-5' }}" style="{{ auth()->check() ? '' : 'margin-top: 80px;' }}">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('berita') }}" style="color: #ef4444; text-decoration: none;">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 30) }}</li>
                </ol>
            </nav>

            <div class="mb-4">
                <span class="badge mb-3" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444; border-radius: 50rem; font-weight: 600; padding: 0.5rem 1rem;">
                    {{ $berita->kategori }}
                </span>
                <h1 class="font-weight-bold" style="color: #111827; letter-spacing: -1px; line-height: 1.3;">{{ $berita->judul }}</h1>
                <div class="d-flex align-items-center mt-3 text-muted">
                    <div class="mr-4"><i class="far fa-calendar-alt mr-2"></i> {{ $berita->created_at->format('d F Y, H:i') }}</div>
                    <div><i class="far fa-user mr-2"></i> Admin Paskibra</div>
                </div>
            </div>

            @if($berita->gambar_sampul)
                <div class="mb-5" style="border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" class="img-fluid w-100">
                </div>
            @endif

            <div class="article-content" style="font-size: 1.1rem; line-height: 1.8; color: #4b5563;">
                {!! $berita->isi !!}
            </div>

            <div class="mt-5 pt-4 border-top">
                <a href="{{ route('berita') }}" class="btn btn-light font-weight-bold" style="border-radius: 50rem; padding: 0.5rem 1.5rem;">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Indeks Berita
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .article-content a {
        color: #ef4444;
        text-decoration: underline;
    }
</style>
@endsection
