@extends('layouts.admin')

@section('title', 'Pengumuman Seleksi - Paskibra')

@section('page-title', 'Pengumuman Seleksi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h5 class="font-weight-bold text-dark">Daftar Pengumuman</h5>
            <p class="text-muted">Pantau terus halaman ini untuk mengetahui informasi terbaru seputar seleksi Paskibra.</p>
        </div>

        @forelse($pengumumans as $p)
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge {{ $p->jenis == 'Penting' || $p->jenis == 'Hasil Seleksi' ? 'badge-danger' : 'badge-info' }} px-3 py-1 rounded-pill mb-2">
                            {{ $p->jenis }}
                        </span>
                        <h4 class="font-weight-bold text-dark mb-1">{{ $p->judul }}</h4>
                    </div>
                    <div class="text-muted small text-right">
                        <i class="fas fa-clock mr-1"></i> {{ $p->created_at->diffForHumans() }}<br>
                        {{ $p->created_at->format('d M Y, H:i') }}
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="pengumuman-content text-dark" style="line-height: 1.6;">
                        {!! $p->isi !!}
                    </div>

                    @if($p->lampiran)
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-paperclip mr-2 text-primary"></i> File Lampiran</h6>
                            <a href="{{ Storage::url($p->lampiran) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fas fa-download mr-1"></i> Unduh Lampiran
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <i class="fas fa-bullhorn text-primary mb-3" style="font-size: 4rem; opacity: 0.8;"></i>
                    <h5 class="font-weight-bold text-dark">Belum Ada Pengumuman</h5>
                    <p class="text-muted">Saat ini belum ada informasi pengumuman yang dibagikan oleh panitia seleksi. Silakan periksa kembali nanti.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('extra-css')
<style>
    .pengumuman-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 10px 0;
    }
</style>
@endsection
