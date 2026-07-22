@extends('layouts.admin')

@section('title', $pengumuman->judul . ' - Paskibra Ganesha')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9 col-12">

        {{-- Back button --}}
        <div class="mb-4 mt-2">
            <a href="{{ route('pengumuman-seleksi.index') }}" class="btn btn-light border font-weight-bold px-3"
                style="border-radius: 8px; font-size: 0.875rem;">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengumuman
            </a>
        </div>

        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-body p-4 p-md-5">

                {{-- Badge Jenis + Tanggal --}}
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3" style="gap: 0.5rem;">
                    <span class="badge {{ $pengumuman->jenis == 'Penting' || $pengumuman->jenis == 'Hasil Seleksi' ? 'badge-danger' : 'badge-info' }} px-3 py-2 rounded-pill font-weight-bold">
                        {{ $pengumuman->jenis }}
                    </span>
                    <small class="text-muted">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $pengumuman->created_at->format('d M Y, H:i') }} WIB
                        &nbsp;·&nbsp;
                        {{ $pengumuman->created_at->diffForHumans() }}
                    </small>
                </div>

                {{-- Judul --}}
                <h2 class="font-weight-bold text-dark mb-4" style="line-height: 1.35; letter-spacing: -0.3px;">
                    {{ $pengumuman->judul }}
                </h2>

                <hr class="mb-4" style="border-color: #f3f4f6;">

                {{-- Isi Pengumuman (rich text dari admin) --}}
                <div class="pengumuman-detail-content text-dark" style="line-height: 1.8; font-size: 0.97rem;">
                    {!! $pengumuman->isi !!}
                </div>

                {{-- ===== LAMPIRAN ===== --}}
                @if($pengumuman->lampiran)
                    @php
                        $ext       = strtolower(pathinfo($pengumuman->lampiran, PATHINFO_EXTENSION));
                        $isImage   = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        $isPdf     = $ext === 'pdf';
                        $lampiranUrl = Storage::url($pengumuman->lampiran);
                    @endphp

                    <div class="mt-5 pt-4" style="border-top: 2px solid #f3f4f6;">
                        <h6 class="font-weight-bold text-dark mb-3">
                            <i class="fas fa-paperclip mr-2 text-primary"></i> File Lampiran
                        </h6>

                        @if($isImage)
                            {{-- Preview langsung jika gambar --}}
                            <div class="text-center mb-3">
                                <img src="{{ $lampiranUrl }}" alt="Lampiran {{ $pengumuman->judul }}"
                                    class="img-fluid shadow-sm"
                                    style="max-height: 480px; border-radius: 0.75rem; border: 1px solid #e5e7eb; cursor: zoom-in;"
                                    onclick="openImgModal(this.src)">
                                <p class="text-muted small mt-2">
                                    <i class="fas fa-search-plus mr-1"></i> Klik gambar untuk perbesar
                                </p>
                            </div>
                            <a href="{{ $lampiranUrl }}" download class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                <i class="fas fa-download mr-2"></i> Unduh Gambar
                            </a>

                        @elseif($isPdf)
                            {{-- Embed PDF viewer --}}
                            <div class="mb-3" style="border: 1px solid #e5e7eb; border-radius: 0.75rem; overflow: hidden;">
                                <iframe src="{{ $lampiranUrl }}"
                                    style="width: 100%; height: 520px; border: none;"
                                    title="Pratinjau PDF Lampiran">
                                    <p class="p-3 text-muted">Browser Anda tidak mendukung pratinjau PDF.
                                        <a href="{{ $lampiranUrl }}" target="_blank">Klik di sini untuk membuka.</a>
                                    </p>
                                </iframe>
                            </div>
                            <a href="{{ $lampiranUrl }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                <i class="fas fa-external-link-alt mr-2"></i> Buka PDF di Tab Baru
                            </a>
                            <a href="{{ $lampiranUrl }}" download class="btn btn-outline-secondary btn-sm rounded-pill px-4 ml-2">
                                <i class="fas fa-download mr-2"></i> Unduh PDF
                            </a>

                        @else
                            {{-- File lain (doc, docx, dll) --}}
                            <div style="background: #f8f9fa; border: 2px dashed #d1d5db; border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                                <i class="fas fa-file-alt text-secondary" style="font-size: 2.5rem;"></i>
                                <div>
                                    <p class="font-weight-bold mb-1" style="color: #111;">{{ basename($pengumuman->lampiran) }}</p>
                                    <small class="text-muted text-uppercase">{{ strtoupper($ext) }} File</small>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ $lampiranUrl }}" download class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                    <i class="fas fa-download mr-2"></i> Unduh Lampiran
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>

        {{-- Back button bawah --}}
        <div class="mt-4 mb-5 text-center">
            <a href="{{ route('pengumuman-seleksi.index') }}" class="btn btn-light border font-weight-bold px-4"
                style="border-radius: 8px;">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengumuman
            </a>
        </div>

    </div>
</div>

{{-- Modal perbesar gambar --}}
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-body text-center p-0 position-relative">
                <button type="button" class="close text-white position-absolute"
                    data-dismiss="modal" aria-label="Close"
                    style="top: -2rem; right: 0; font-size: 2rem; z-index: 10;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img id="imgModalSrc" src="" alt="Lampiran"
                    style="max-width: 100%; max-height: 88vh; border-radius: 0.75rem; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
    .pengumuman-detail-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 12px 0;
    }
    .pengumuman-detail-content p {
        margin-bottom: 0.9rem;
    }
    .pengumuman-detail-content ul,
    .pengumuman-detail-content ol {
        padding-left: 1.5rem;
        margin-bottom: 0.9rem;
    }
    .pengumuman-detail-content h1,
    .pengumuman-detail-content h2,
    .pengumuman-detail-content h3 {
        font-weight: 700;
        margin-top: 1.5rem;
    }
    #imgModal .modal-dialog {
        max-width: 90vw;
    }
</style>
@endsection

@section('extra-js')
<script>
    function openImgModal(src) {
        document.getElementById('imgModalSrc').src = src;
        $('#imgModal').modal('show');
    }
</script>
@endsection
