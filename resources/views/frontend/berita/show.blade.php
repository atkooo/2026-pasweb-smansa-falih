@extends('layouts.app')

@section('title', $berita->judul . ' - Paskibra Ganesha')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('berita') }}" class="fw-semibold text-decoration-none" style="color: #d10000;">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->judul, 35) }}</li>
                </ol>
            </nav>

            <div class="mb-4">
                <span class="badge mb-3 shadow-sm" style="background-color: rgba(209, 0, 0, 0.1); color: #d10000; border-radius: 50rem; font-weight: 700; padding: 0.5rem 1.2rem; font-size: 0.8rem;">
                    {{ $berita->kategori }}
                </span>
                <h1 class="fw-bold text-dark mb-3" style="letter-spacing: -0.5px; line-height: 1.3;">{{ $berita->judul }}</h1>
                <div class="d-flex align-items-center flex-wrap gap-3 text-muted" style="font-size: 0.9rem;">
                    <div><i class="far fa-calendar-alt me-1 text-danger"></i> {{ $berita->created_at->format('d F Y, H:i') }} WIB</div>
                    <div><i class="far fa-user me-1 text-danger"></i> Admin Paskibra</div>
                </div>
            </div>

            @if($berita->gambar_sampul)
                <div class="mb-5 shadow-sm" style="border-radius: 1.25rem; overflow: hidden;">
                    <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" class="img-fluid w-100 object-fit-cover" style="max-height: 480px;">
                </div>
            @endif

            <div class="card border-0 p-4 p-md-5 mb-5 shadow-sm" style="border-radius: 1.25rem; background: #ffffff;">
                <div class="article-content" style="font-size: 1.05rem; line-height: 1.85; color: #374151;">
                    {!! $berita->isi !!}
                </div>
            </div>

            <div class="mt-4 pt-3 border-top">
                <a href="{{ route('berita') }}" class="btn btn-outline-danger rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Indeks Berita
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.8rem;
        margin: 1.5rem 0;
    }
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .article-content a {
        color: #d10000;
        text-decoration: underline;
    }
</style>
@endsection
