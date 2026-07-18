@extends('layouts.admin')

@section('title', 'Notifikasi & Pengumuman - Paskibra Ganesha')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="font-weight-bold text-dark mb-0">Notifikasi & Pengumuman</h3>
        <p class="text-muted mb-0">Pusat informasi dan pembaruan status seleksi Anda</p>
    </div>
</div>

<div class="row">
    <!-- Kolom Kiri: Notifikasi Personal -->
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-user-bell text-primary mr-2"></i> Status Anda Saat Ini</h5>
            </div>
            <div class="card-body p-4">
                @if($formulir)
                    @if($formulir->status_pendaftaran === 'pending')
                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-start p-4" style="border-radius: 0.5rem; background: rgba(245, 158, 11, 0.1); color: #b45309;">
                            <i class="fas fa-hourglass-half mt-1 mr-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="font-weight-bold mb-1">Berkas Sedang Direview</h6>
                                <p class="mb-0 small">Formulir pendaftaran Anda telah kami terima dan sedang dalam tahap verifikasi oleh panitia. Harap bersabar menunggu hasil seleksi administrasi.</p>
                                <hr style="border-color: rgba(245, 158, 11, 0.2);">
                                <small class="font-weight-bold"><i class="far fa-clock mr-1"></i> Dikirim: {{ $formulir->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                    @elseif($formulir->status_pendaftaran === 'approved')
                        <div class="alert alert-success border-0 shadow-sm d-flex align-items-start p-4" style="border-radius: 0.5rem; background: rgba(16, 185, 129, 0.1); color: #047857;">
                            <i class="fas fa-check-circle mt-1 mr-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="font-weight-bold mb-1">Selamat! Berkas Disetujui</h6>
                                <p class="mb-0 small">Anda telah lolos seleksi administrasi. Persiapkan diri Anda untuk mengikuti tahapan seleksi selanjutnya. Pantau terus Papan Pengumuman untuk jadwal tes fisik dan wawancara.</p>
                            </div>
                        </div>
                    @elseif($formulir->status_pendaftaran === 'rejected')
                        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-start p-4" style="border-radius: 0.5rem; background: rgba(239, 68, 68, 0.1); color: #b91c1c;">
                            <i class="fas fa-times-circle mt-1 mr-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <h6 class="font-weight-bold mb-1">Mohon Maaf</h6>
                                <p class="mb-0 small">Berkas pendaftaran Anda tidak memenuhi syarat setelah dilakukan verifikasi. Tetap semangat dan jangan menyerah!</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mb-4" style="width: 70px; height: 70px; background: rgba(239, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                            <i class="fas fa-file-signature text-danger" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="font-weight-bold text-dark mb-2">Belum Ada Notifikasi Status</h6>
                        <p class="text-muted mb-4 small">Anda belum mendaftar. Silakan isi formulir terlebih dahulu.</p>
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-danger px-4 py-2 font-weight-bold rounded-pill shadow-sm small">
                            Isi Formulir Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Papan Pengumuman Global -->
    <div class="col-lg-7 mb-4">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 0.75rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h5 class="font-weight-bold m-0 text-dark"><i class="fas fa-bullhorn text-warning mr-2"></i> Papan Pengumuman</h5>
            </div>
            <div class="card-body p-4">
                @if($pengumuman->count() > 0)
                    <div class="timeline">
                        @foreach($pengumuman as $info)
                            <div class="timeline-item mb-4 pb-3 border-bottom">
                                <div class="d-flex align-items-start">
                                    <div class="mr-3 mt-1">
                                        <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-info-circle" style="font-size: 1.25rem;"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="font-weight-bold text-dark mb-0">{{ $info->jenis_info }}</h6>
                                            <span class="badge badge-light text-muted border"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($info->tanggal_update)->format('d M Y') }}</span>
                                        </div>
                                        <p class="text-muted small mt-2 mb-2" style="line-height: 1.6;">{{ $info->konten }}</p>
                                        
                                        @if($info->gambar_info)
                                            <div class="mt-3">
                                                <img src="{{ Storage::url($info->gambar_info) }}" alt="Gambar Pengumuman" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: cover;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-inbox text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                        </div>
                        <h6 class="font-weight-bold text-dark">Belum Ada Pengumuman</h6>
                        <p class="text-muted small">Panitia belum mempublikasikan informasi apa pun saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
