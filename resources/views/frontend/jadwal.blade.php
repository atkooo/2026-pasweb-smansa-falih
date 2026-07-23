@extends('layouts.app')

@section('title', 'Jadwal Kegiatan - Paskibra Ganesha')

@section('content')
<div class="container py-3">
    <div class="text-center mb-5 mx-auto" style="max-width: 800px;">
        <h2 class="font-weight-bold mb-3 section-title">JADWAL</h2>
        <p class="fw-semibold text-dark mb-1" style="font-size: 1.15rem;">Kegiatan Paskibra Ganesha</p>
        <p class="text-muted" style="font-size: 0.97rem;">SMA Negeri 1 Pontianak</p>
    </div>

    <div class="row justify-content-center">
        <!-- Card Jadwal Latihan Rutin Mingguan -->
        <div class="col-lg-10 col-xl-9 mb-5">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 1.25rem; background: #ffffff; border: 1px solid rgba(209, 0, 0, 0.1) !important; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <span class="badge px-3 py-1 rounded-pill mb-2 text-white shadow-sm" style="background: linear-gradient(135deg, #d10000 0%, #ff3333 100%); font-size: 0.8rem; letter-spacing: 1px; font-weight: 700;">
                                <i class="fas fa-sync-alt me-1"></i> AGENDA RUTIN
                            </span>
                            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Latihan Rutin</h3>
                            <p class="text-muted mb-0" style="font-size: 0.95rem;">Latihan rutin dilaksanakan secara terstruktur untuk membina kedisiplinan, fisik, dan kebersamaan anggota.</p>
                        </div>
                        <div class="text-center p-3 rounded-4 bg-white shadow-sm border border-light" style="min-width: 140px;">
                            <span class="d-block text-muted small fw-semibold text-uppercase" style="letter-spacing: 1px;">HARI LATIHAN</span>
                            <span class="fw-black text-danger d-block fs-4" style="font-weight: 900; color: #d10000 !important;">SABTU</span>
                        </div>
                    </div>

                    <div class="row g-3 pt-3 border-top border-light">
                        <div class="col-sm-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle me-3" style="width: 44px; height: 44px; background-color: rgba(209, 0, 0, 0.08); border-radius: 50%;">
                                    <i class="far fa-clock text-danger fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.8rem;">Waktu Pelaksanaan</small>
                                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">06:00 - 09:30 WIB</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle me-3" style="width: 44px; height: 44px; background-color: rgba(209, 0, 0, 0.08); border-radius: 50%;">
                                    <i class="fas fa-map-marker-alt text-danger fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.8rem;">Lokasi Latihan</small>
                                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">Lapangan SMA Negeri 1 Pontianak</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Daftar Agenda Kegiatan -->
        <div class="col-lg-10 col-xl-9">
            @if($jadwals->isEmpty())
                <div class="card border-0 text-center py-5 shadow-sm" style="border-radius: 1.25rem; background: #ffffff;">
                    <div class="card-body">
                        <div class="text-muted mb-3"><i class="far fa-calendar-times fa-4x" style="color: #d10000; opacity: 0.3;"></i></div>
                        <h5 class="fw-bold text-dark">Belum Ada Agenda Khusus</h5>
                        <p class="text-muted mb-0">Belum ada agenda khusus yang dipublikasikan saat ini. Silakan periksa kembali di lain waktu.</p>
                    </div>
                </div>
            @else
                <div class="timeline-container position-relative">
                    <!-- Vertical line -->
                    <div class="timeline-line"></div>

                    @foreach($jadwals as $jadwal)
                        <div class="timeline-item d-flex align-items-stretch gap-3 gap-md-4 mb-4 position-relative">
                            <!-- Dot on the line -->
                            <div class="timeline-dot flex-shrink-0"></div>

                            <!-- Card Content -->
                            <div class="card flex-grow-1 border-0 schedule-card ms-2">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem; line-height: 1.5;">
                                        {{ $jadwal->nama_kegiatan }}
                                    </h5>
                                    @if($jadwal->deskripsi)
                                        <p class="text-muted mb-0" style="font-size: 0.93rem; line-height: 1.6;">
                                            {{ $jadwal->deskripsi }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
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

    /* Timeline Layout */
    .timeline-container {
        padding-left: 24px;
    }
    .timeline-line {
        position: absolute;
        left: 10px;
        top: 12px;
        bottom: 12px;
        width: 2px;
        background: linear-gradient(180deg, #d10000 0%, rgba(209,0,0,0.1) 100%);
        border-radius: 2px;
    }
    .timeline-dot {
        width: 18px;
        height: 18px;
        min-width: 18px;
        border-radius: 50%;
        background: #d10000;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #d10000;
        position: absolute;
        left: -30px;
        top: 20px;
        z-index: 1;
    }

    .schedule-card {
        border-radius: 1.25rem !important;
        border: 1px solid rgba(0, 0, 0, 0.06) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .schedule-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 35px rgba(209, 0, 0, 0.1) !important;
        border-color: rgba(209, 0, 0, 0.15) !important;
    }
    .icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 576px) {
        .timeline-container {
            padding-left: 20px;
        }
        .timeline-dot {
            left: -26px;
            width: 14px;
            height: 14px;
            min-width: 14px;
        }
    }
</style>
@endsection