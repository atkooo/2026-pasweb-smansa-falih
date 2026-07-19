@extends('layouts.admin')

@section('title', 'Dashboard Anggota - Paskibra Ganesha')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem; overflow: hidden; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white;">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center mb-4 mb-md-0">
                            <div class="position-relative mr-4 mr-md-5">
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-white font-weight-bold" style="width: 80px; height: 80px; font-size: 2rem; color: #1e3a8a;">
                                    {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                                </div>
                                <div class="position-absolute bg-success rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 25px; height: 25px; bottom: 0; right: 0; border: 2px solid white;">
                                    <i class="fas fa-check text-white" style="font-size: 0.7rem;"></i>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="font-weight-bold mb-1">
                                    {{ auth()->user()->nama_lengkap }}
                                </h3>
                                <h6 class="mb-3 text-light" style="opacity: 0.9;">Anggota Resmi Paskibra SMA Negeri 1 Pontianak</h6>
                                
                                <span class="badge badge-light px-3 py-2" style="border-radius: 20px; font-weight: 600; color: #1e3a8a;">
                                    <i class="fas fa-id-badge mr-2"></i> {{ auth()->user()->nisn ?? 'NISN/NIK' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center" style="border-left: 1px solid rgba(255,255,255,0.2);">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Paskibra" style="width: 120px; height: auto;" class="mb-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Jadwal Mendatang -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-dark"><i class="fas fa-calendar-alt text-primary mr-2"></i> Jadwal Kegiatan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mt-2">
                        @forelse($jadwalMendatang as $jadwal)
                            <li class="list-group-item px-0 border-bottom-0 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="bg-light rounded p-3 text-center mr-3" style="min-width: 70px;">
                                        <span class="d-block font-weight-bold text-primary" style="font-size: 1.2rem;">{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d') }}</span>
                                        <span class="d-block text-muted small">{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->translatedFormat('M') }}</span>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold text-dark mb-1">{{ $jadwal->nama_kegiatan }}</h6>
                                        <p class="text-muted small mb-1"><i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</p>
                                        <p class="text-muted small mb-0"><i class="fas fa-map-marker-alt mr-1"></i> {{ $jadwal->tempat }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item px-0 border-0 text-center text-muted py-4">
                                <i class="far fa-calendar-times mb-2" style="font-size: 2rem; opacity: 0.5;"></i><br>
                                Tidak ada jadwal kegiatan dalam waktu dekat.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Berita Internal -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-dark"><i class="fas fa-bullhorn text-warning mr-2"></i> Informasi Terbaru</h4>
                </div>
                <div class="card-body">
                    <div class="mt-2">
                        @forelse($beritaTerbaru as $berita)
                            <div class="mb-3 pb-3 border-bottom">
                                <h6 class="font-weight-bold text-dark mb-1">{{ $berita->judul }}</h6>
                                <p class="text-muted small mb-2"><i class="far fa-clock mr-1"></i> {{ $berita->created_at->diffForHumans() }}</p>
                                <p class="text-secondary small mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ strip_tags($berita->konten) }}
                                </p>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                <i class="far fa-newspaper mb-2" style="font-size: 2rem; opacity: 0.5;"></i><br>
                                Belum ada informasi atau berita terbaru.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
