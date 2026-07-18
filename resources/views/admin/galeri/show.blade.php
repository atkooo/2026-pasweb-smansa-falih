@extends('layouts.admin')

@section('title', 'Detail Album: ' . $judul . ' - Paskibra')

@section('content')
<div class="mb-4 mt-2 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('galeri.index') }}" class="text-muted text-decoration-none small mb-1 d-block"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Galeri</a>
        <h3 class="font-weight-bold text-dark mb-1" style="letter-spacing: -0.5px;">Album: {{ $judul }}</h3>
        <p class="text-muted" style="font-size: 0.95rem;">Total {{ $photos->count() }} foto dalam album ini.</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 0.5rem;">
        <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Peringatan!</strong>
        <ul class="mb-0 mt-1 pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Grid Foto -->
<div class="row">
    @foreach($photos as $photo)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card border-0 h-100 gallery-card-admin">
                <div class="card-img-wrapper-admin" style="height: 250px; border-radius: 16px;">
                    <img src="{{ asset('storage/' . $photo->file_foto) }}" class="gallery-img-admin">
                    <div class="img-overlay-admin d-flex justify-content-end" style="z-index: 10;">
                        <form action="{{ route('galeri.destroy', $photo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto spesifik ini dari album?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow-sm btn-action-admin" title="Hapus Foto">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    /* Admin Gallery Card Styling */
    .gallery-card-admin {
        border-radius: 16px !important;
        transition: all 0.3s ease;
        background-color: transparent;
    }
    .card-img-wrapper-admin {
        position: relative;
        overflow: hidden;
        background-color: #f3f4f6;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .gallery-card-admin:hover .card-img-wrapper-admin {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }
    .gallery-img-admin {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-card-admin:hover .gallery-img-admin {
        transform: scale(1.05);
    }
    .img-overlay-admin {
        position: absolute;
        top: 0;
        right: 0;
        padding: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-card-admin:hover .img-overlay-admin {
        opacity: 1;
    }
    .btn-action-admin {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-action-admin:hover {
        transform: scale(1.1);
    }
</style>
@endsection
