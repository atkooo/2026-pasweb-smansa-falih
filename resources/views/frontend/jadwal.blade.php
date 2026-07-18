@extends('layouts.app')

@section('title', 'Jadwal Kegiatan - Paskibra Ganesha')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold" style="color: #111827; letter-spacing: -1px;">Agenda & Jadwal Latihan</h2>
        <p class="text-muted text-lg">Informasi lengkap mengenai jadwal latihan rutin dan agenda kegiatan Paskibra Ganesha.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($jadwals->isEmpty())
                <div class="text-center py-5">
                    <div class="text-muted mb-3"><i class="far fa-calendar-times fa-4x" style="opacity: 0.2;"></i></div>
                    <h5 class="text-muted">Belum ada jadwal kegiatan yang dipublikasikan saat ini.</h5>
                </div>
            @else
                <div class="timeline">
                    @php
                        // Group jadwal by month and year
                        $groupedJadwals = $jadwals->groupBy(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('F Y');
                        });
                    @endphp

                    @foreach($groupedJadwals as $month => $schedules)
                        <div class="timeline-month-divider">
                            <span class="badge" style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 50rem; font-size: 0.9rem; font-weight: 600;">
                                {{ \Carbon\Carbon::parse($schedules->first()->tanggal_kegiatan)->translatedFormat('F Y') }}
                            </span>
                        </div>
                        
                        @foreach($schedules as $jadwal)
                            @php
                                $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_kegiatan);
                                $isPast = $tanggal->isPast() && !$tanggal->isToday();
                            @endphp
                            <div class="timeline-item {{ $isPast ? 'timeline-past' : '' }}">
                                <div class="timeline-date">
                                    <div class="date-box {{ $isPast ? 'bg-light text-muted' : '' }}">
                                        <span class="day font-weight-bold d-block" style="font-size: 1.5rem; line-height: 1;">{{ $tanggal->format('d') }}</span>
                                        <span class="month text-uppercase" style="font-size: 0.8rem; font-weight: 600;">{{ $tanggal->translatedFormat('M') }}</span>
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <div class="card h-100 {{ $isPast ? 'bg-light border-0' : '' }}" style="border-radius: 1rem; box-shadow: {{ $isPast ? 'none' : '0 4px 15px rgba(0,0,0,0.05)' }}; border: {{ $isPast ? 'none' : '1px solid #f3f4f6' }}; transition: transform 0.2s;">
                                        <div class="card-body p-4">
                                            <h5 class="font-weight-bold mb-3 {{ $isPast ? 'text-muted' : '' }}">{{ $jadwal->nama_kegiatan }}</h5>
                                            
                                            <div class="d-flex flex-wrap {{ $isPast ? 'text-muted' : '' }}">
                                                <div class="mr-4 mb-2">
                                                    <i class="far fa-clock mr-2" style="color: {{ $isPast ? '#9ca3af' : '#ef4444' }};"></i> 
                                                    {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB
                                                </div>
                                                <div class="mb-2">
                                                    <i class="fas fa-map-marker-alt mr-2" style="color: {{ $isPast ? '#9ca3af' : '#3b82f6' }};"></i> 
                                                    {{ $jadwal->tempat }}
                                                </div>
                                            </div>
                                            
                                            @if($isPast)
                                                <span class="badge badge-secondary mt-2" style="background-color: #e5e7eb; color: #6b7280;">Selesai</span>
                                            @elseif($tanggal->isToday())
                                                <span class="badge mt-2" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">Hari Ini</span>
                                            @endif
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
    .timeline {
        position: relative;
        padding-left: 3rem;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e5e7eb;
    }
    .timeline-month-divider {
        position: relative;
        margin: 2rem 0;
        margin-left: -3rem;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
    }
    .timeline-date {
        position: absolute;
        left: -3rem;
        top: 0;
        transform: translateX(-50%);
        z-index: 2;
    }
    .date-box {
        width: 60px;
        height: 60px;
        background-color: white;
        border: 2px solid #3b82f6;
        border-radius: 0.75rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .timeline-past .date-box {
        border-color: #d1d5db;
        box-shadow: none;
    }
    .timeline-content .card:hover {
        transform: translateY(-3px);
    }
    .timeline-past .timeline-content .card:hover {
        transform: none;
    }
    
    @media (max-width: 768px) {
        .timeline {
            padding-left: 1.5rem;
        }
        .timeline::before {
            left: 1.5rem;
        }
        .timeline-month-divider {
            margin-left: -1.5rem;
        }
        .timeline-date {
            left: 1.5rem;
        }
        .date-box {
            width: 50px;
            height: 50px;
        }
        .date-box .day {
            font-size: 1.2rem !important;
        }
        .date-box .month {
            font-size: 0.7rem !important;
        }
        .timeline-content {
            margin-left: 2.5rem;
        }
    }
</style>
@endsection