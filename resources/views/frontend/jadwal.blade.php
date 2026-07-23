@extends(auth()->check() ? 'layouts.admin' : 'layouts.app')

@section('title', 'Jadwal Kegiatan - Paskibra Ganesha')

@section('content')
<div class="{{ auth()->check() ? 'mt-2 mb-4' : 'container py-3' }}">
    <div class="{{ auth()->check() ? 'mb-4' : 'text-center mb-5 mx-auto' }}" style="{{ auth()->check() ? '' : 'max-width: 800px;' }}">
        <h2 class="font-weight-bold mb-3 {{ auth()->check() ? 'text-dark' : 'section-title' }}">JADWAL KEGIATAN</h2>
        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.7; font-weight: 400;">
            Informasi lengkap mengenai agenda latihan rutin mingguan dan jadwal acara Paskibra Ganesha SMA Negeri 1 Pontianak.
        </p>
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
                            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Latihan Rutin Mingguan</h3>
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
                                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">15:30 - 17:30 WIB</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5">
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
                        <div class="col-sm-12 col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle me-3" style="width: 44px; height: 44px; background-color: rgba(209, 0, 0, 0.08); border-radius: 50%;">
                                    <i class="fas fa-tshirt text-danger fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.8rem;">Pakaian</small>
                                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">Kaos Latihan Paskibra</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agenda & Timeline Events -->
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
                <div class="timeline-container">
                    @php
                        // Group jadwal by month and year
                        $groupedJadwals = $jadwals->groupBy(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('F Y');
                        });
                    @endphp

                    @foreach($groupedJadwals as $month => $schedules)
                        <div class="month-header d-flex align-items-center gap-3 my-4">
                            <span class="badge shadow-sm px-4 py-2 rounded-pill text-white" style="background: linear-gradient(135deg, #d10000 0%, #ff3333 100%); font-size: 0.95rem; font-weight: 700; letter-spacing: 0.5px;">
                                <i class="far fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($schedules->first()->tanggal_kegiatan)->translatedFormat('F Y') }}
                            </span>
                            <div class="flex-grow-1" style="height: 2px; background: linear-gradient(90deg, rgba(209, 0, 0, 0.25) 0%, transparent 100%); border-radius: 2px;"></div>
                        </div>
                        
                        @foreach($schedules as $jadwal)
                            @php
                                $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_kegiatan);
                                $isPast = $tanggal->isPast() && !$tanggal->isToday();
                                $isToday = $tanggal->isToday();
                            @endphp
                            <div class="timeline-item d-flex align-items-stretch gap-3 gap-md-4 mb-4">
                                <!-- Date Box -->
                                <div class="date-box flex-shrink-0 {{ $isPast ? 'date-box-past' : 'date-box-active' }}">
                                    <span class="day">{{ $tanggal->format('d') }}</span>
                                    <span class="month">{{ $tanggal->translatedFormat('M') }}</span>
                                </div>

                                <!-- Card Content -->
                                <div class="card flex-grow-1 border-0 {{ $isPast ? 'bg-light opacity-75' : 'schedule-card' }}">
                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                                            <h5 class="fw-bold mb-0 {{ $isPast ? 'text-muted' : 'text-dark' }}" style="font-size: 1.15rem; line-height: 1.5;">
                                                {{ $jadwal->nama_kegiatan }}
                                            </h5>
                                            @if($isPast)
                                                <span class="badge px-3 py-1 rounded-pill" style="background-color: #e5e7eb; color: #6b7280; font-size: 0.75rem;">Selesai</span>
                                            @elseif($isToday)
                                                <span class="badge px-3 py-1 rounded-pill" style="background-color: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.75rem; font-weight: 700;">Hari Ini</span>
                                            @else
                                                <span class="badge px-3 py-1 rounded-pill" style="background-color: rgba(209, 0, 0, 0.1); color: #d10000; font-size: 0.75rem; font-weight: 700;">Mendatang</span>
                                            @endif
                                        </div>
                                        
                                        <div class="d-flex flex-wrap gap-4 {{ $isPast ? 'text-muted' : '' }}" style="font-size: 0.95rem;">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle me-2 {{ $isPast ? 'bg-secondary-soft' : 'bg-danger-soft' }}">
                                                    <i class="far fa-clock" style="color: {{ $isPast ? '#9ca3af' : '#d10000' }};"></i>
                                                </div>
                                                <span class="fw-medium">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="icon-circle me-2 {{ $isPast ? 'bg-secondary-soft' : 'bg-danger-soft' }}">
                                                    <i class="fas fa-map-marker-alt" style="color: {{ $isPast ? '#9ca3af' : '#d10000' }};"></i>
                                                </div>
                                                <span class="fw-medium">{{ $jadwal->tempat }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

    .date-box {
        width: 70px;
        height: 70px;
        min-width: 70px;
        border-radius: 1.1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .date-box .day {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
    }
    .date-box .month {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-top: 2px;
    }
    .date-box-active {
        background: linear-gradient(135deg, #d10000 0%, #9e0000 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(209, 0, 0, 0.25);
    }
    .date-box-past {
        background-color: #f3f4f6;
        color: #6b7280;
        border: 2px solid #e5e7eb;
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
    .bg-danger-soft {
        background-color: rgba(209, 0, 0, 0.08);
    }
    .bg-secondary-soft {
        background-color: #f3f4f6;
    }
    
    @media (max-width: 576px) {
        .date-box {
            width: 58px;
            height: 58px;
            min-width: 58px;
            border-radius: 0.9rem;
        }
        .date-box .day {
            font-size: 1.25rem;
        }
        .date-box .month {
            font-size: 0.65rem;
        }
    }
</style>
@endsection