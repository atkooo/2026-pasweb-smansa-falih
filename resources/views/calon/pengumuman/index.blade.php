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
            <a href="{{ route('pengumuman-seleksi.show', $p->id) }}" class="text-decoration-none d-block mb-4 pengumuman-card-link">
                <div class="card shadow-sm border-0" style="border-radius: 1rem; cursor: pointer;">
                    <div class="card-body px-4 pt-4 pb-3">
                        {{-- Header: Badge + Waktu --}}
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                                <span class="badge {{ $p->jenis == 'Penting' || $p->jenis == 'Hasil Seleksi' ? 'badge-danger' : 'badge-info' }} px-3 py-1 rounded-pill">
                                    {{ $p->jenis }}
                                </span>
                                @if($p->lampiran)
                                    <span class="badge badge-secondary px-2 py-1 rounded-pill" style="font-size: 0.7rem;">
                                        <i class="fas fa-paperclip mr-1"></i> Lampiran
                                    </span>
                                @endif
                            </div>
                            <small class="text-muted ml-2" style="white-space: nowrap;">
                                <i class="fas fa-clock mr-1"></i>{{ $p->created_at->diffForHumans() }}
                            </small>
                        </div>

                        {{-- Judul --}}
                        <h5 class="font-weight-bold text-dark mb-2" style="line-height: 1.4;">{{ $p->judul }}</h5>

                        {{-- Preview isi singkat --}}
                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ Str::limit(strip_tags($p->isi), 160) }}
                        </p>

                        {{-- Footer: Tanggal + CTA --}}
                        <div class="d-flex justify-content-between align-items-center" style="border-top: 1px solid #f3f4f6; padding-top: 0.75rem;">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt mr-1"></i>{{ $p->created_at->format('d M Y, H:i') }}
                            </small>
                            <span class="text-primary font-weight-bold" style="font-size: 0.85rem;">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </a>
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
    .pengumuman-card-link:hover .card {
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
        transform: translateY(-2px);
    }
    .pengumuman-card-link .card {
        transition: box-shadow 0.2s ease, transform 0.15s ease;
    }
</style>
@endsection
