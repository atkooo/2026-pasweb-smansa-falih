@extends('layouts.app')

@section('title', 'Jadwal Kegiatan - Paskibra Ganesha')

@section('content')
<div class="container py-3">
    <div class="text-center mb-5 mx-auto" style="max-width: 800px;">
        <h2 class="font-weight-bold mb-3 section-title">JADWAL</h2>
        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.7; font-weight: 400;">
            Setiap kegiatan adalah langkah dalam membentuk disiplin, menumbuhkan kebersamaan, dan mengukir pengalaman berharga sebagai bagian dari keluarga besar Paskibra.
        </p>
    </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 main-jadwal-card">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge px-3 py-2 rounded-pill text-white fw-bold shadow-xs" style="background: linear-gradient(135deg, #d10000 0%, #ef4444 100%); font-size: 0.78rem; letter-spacing: 0.5px;">
                        <i class="fas fa-sync-alt me-1"></i> AGENDA RUTIN MINGGUAN
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 rounded-pill small fw-semibold">
                        <i class="fas fa-check-circle me-1"></i> Aktif Terjadwal
                    </span>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center g-4 mb-4">
                    <div class="col-lg-8">
                        <h3 class="fw-bold text-dark mb-2" style="font-size: 1.6rem;">
                            Latihan Rutin Paskibra Ganesha
                        </h3>
                        <p class="text-muted mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                            Latihan yang dilaksanakan secara rutin sebagai sarana pembinaan disiplin, ketahanan fisik, keterampilan PBB, dan kerja sama tim.
                        </p>
                        
                        <!-- Feature Chips -->
                        <div class="d-flex flex-wrap gap-2">
                            <span class="chip-pill"><i class="fas fa-walking text-danger me-1"></i> PBB & Formasi</span>
                            <span class="chip-pill"><i class="fas fa-heartbeat text-danger me-1"></i> Ketahanan Fisik</span>
                            <span class="chip-pill"><i class="fas fa-users text-danger me-1"></i> Pembentukan Karakter</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="p-3 text-center rounded-4 border bg-light shadow-xs position-relative" style="border-color: rgba(209, 0, 0, 0.15) !important;">
                            <div class="text-uppercase fw-bold text-muted small mb-1" style="letter-spacing: 1px;">HARI LATIHAN</div>
                            <div class="fw-black text-danger display-6 mb-0" style="font-weight: 900; color: #d10000 !important;">SABTU</div>
                        </div>
                    </div>
                </div>

                <!-- 4 Quick Key Info Boxes Grid -->
                <div class="row g-3 pt-3 border-top">
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border-0 h-100">
                            <div class="text-danger small fw-bold mb-1"><i class="far fa-clock me-1"></i> WAKTU SESI</div>
                            <div class="fw-bold text-dark small">06:00 - 09:30 WIB</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Hadir 15m sebelum apel</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border-0 h-100">
                            <div class="text-danger small fw-bold mb-1"><i class="fas fa-map-marker-alt me-1"></i> LOKASI</div>
                            <div class="fw-bold text-dark small">Lapangan Utama</div>
                            <div class="text-muted" style="font-size: 0.75rem;">SMA Negeri 1 Pontianak</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border-0 h-100">
                            <div class="text-danger small fw-bold mb-1"><i class="fas fa-tshirt me-1"></i> SERAGAM</div>
                            <div class="fw-bold text-dark small">Seragam Olahraga Sekolah</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Sepatu olahraga, kaos kaki hitam</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-3 bg-light border-0 h-100">
                            <div class="text-danger small fw-bold mb-1"><i class="fas fa-box-open me-1"></i> PERLENGKAPAN</div>
                            <div class="fw-bold text-dark small">Air Minum, Roti</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Handuk Good Morning</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Header: Agenda Khusus -->
        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
            <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="fas fa-bullhorn text-danger"></i> AGENDA KHUSUS & KEGIATAN MENDATANG
            </h5>
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill font-monospace small">
                {{ $jadwals->count() }} Agenda
            </span>
        </div>

        <!-- List Agenda Khusus -->
        <div class="mb-4">
            @if($jadwals->isEmpty())
                <div class="card border-0 text-center py-4 px-3 shadow-xs rounded-4 bg-white">
                    <div class="card-body">
                        <div class="text-danger mb-2 opacity-50"><i class="far fa-calendar-alt fa-3x"></i></div>
                        <h6 class="fw-bold text-dark mb-1">Belum Ada Agenda Khusus Tambahan</h6>
                        <p class="text-muted small mb-0">Saat ini belum ada agenda pengumuman atau seleksi khusus. Kegiatan tetap berfokus pada <strong>Latihan Rutin Mingguan</strong>.</p>
                    </div>
                </div>
            @else
                <div class="row g-3">
                    @foreach($jadwals as $index => $jadwal)
                        <div class="col-12">
                            <div class="card border-0 shadow-xs rounded-4 bg-white p-3 p-md-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded-pill small fw-bold">
                                        #AGENDA {{ sprintf('%02d', $index + 1) }}
                                    </span>
                                    <span class="text-muted small">
                                        <i class="far fa-clock me-1"></i> {{ $jadwal->created_at ? $jadwal->created_at->diffForHumans() : 'Baru' }}
                                    </span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1 fs-6">
                                    {{ $jadwal->nama_kegiatan }}
                                </h6>
                                @if($jadwal->deskripsi)
                                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                                        {{ $jadwal->deskripsi }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Tata Tertib / Guidelines (Neat Grid) -->
        <div class="mt-4 pt-2">
            <div class="text-center mb-3">
                <h6 class="fw-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.5px;">
                    <i class="fas fa-shield-alt text-danger me-1"></i> Panduan & Tata Tertib Latihan
                </h6>
                <p class="text-muted small mb-0">Ketentuan utama bagi seluruh anggota Paskibra Ganesha</p>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-4 border shadow-xs h-100">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="text-danger bg-danger-subtle rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="fas fa-stopwatch"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0 small">Ketepatan Waktu</h6>
                        </div>
                        <p class="text-muted small mb-0" style="font-size: 0.82rem; line-height: 1.5;">
                            Hadir setidaknya 15 menit sebelum latihan dimulai untuk mengisi daftar hadir dan persiapan apel.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-4 border shadow-xs h-100">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="text-danger bg-danger-subtle rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0 small">Kelengkapan Seragam</h6>
                        </div>
                        <p class="text-muted small mb-0" style="font-size: 0.82rem; line-height: 1.5;">
                            Mengenakan seragam olahraga / PDL resmi yang rapi serta sepatu olahraga.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-white rounded-4 border shadow-xs h-100">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="text-danger bg-danger-subtle rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0 small">Kesehatan & Stamina</h6>
                        </div>
                        <p class="text-muted small mb-0" style="font-size: 0.82rem; line-height: 1.5;">
                            Pastikan fisik dalam kondisi baik, cukup istirahat, dan telah sarapan secukupnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .jadwal-page {
        background-color: #f8fafc;
        min-height: 100vh;
    }

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

    .main-jadwal-card {
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
    }

    .chip-pill {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        font-size: 0.8rem;
        color: #475569;
        font-weight: 500;
    }
</style>
@endsection