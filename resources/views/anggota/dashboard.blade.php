@extends('layouts.admin')

@section('title', 'Dashboard Anggota - Paskibra Ganesha')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0"
                style="border-radius: 1rem; overflow: hidden; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white;">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center mb-4 mb-md-0">
                            <div class="position-relative mr-4 mr-md-5">
                                @if(auth()->user()->foto)
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                        alt="{{ auth()->user()->nama_lengkap }}" class="rounded-circle shadow"
                                        style="width: 80px; height: 80px; object-fit: cover; border: 3px solid white;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-white font-weight-bold"
                                        style="width: 80px; height: 80px; font-size: 2rem; color: #1e3a8a;">
                                        {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="position-absolute bg-success rounded-circle d-flex align-items-center justify-content-center shadow"
                                    style="width: 25px; height: 25px; bottom: 0; right: 0; border: 2px solid white;">
                                    <i class="fas fa-check text-white" style="font-size: 0.7rem;"></i>
                                </div>
                            </div>

                            <div>
                                <h3 class="font-weight-bold mb-1">
                                    {{ auth()->user()->nama_lengkap }}
                                </h3>
                                <h6 class="mb-3 text-light" style="opacity: 0.9;">Anggota Resmi Paskibra SMA Negeri 1
                                    Pontianak</h6>

                                <span class="badge badge-light px-3 py-2"
                                    style="border-radius: 20px; font-weight: 600; color: #1e3a8a;">
                                    <i class="fas fa-id-badge mr-2"></i> {{ auth()->user()->nisn ?? 'NISN/NIK' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center"
                            style="border-left: 1px solid rgba(255,255,255,0.2);">
                            <img src="{{ asset('images/logo.webp') }}" alt="Logo Paskibra"
                                style="width: 100px; height: auto;" class="mb-2">
                            <button type="button"
                                class="btn btn-warning rounded-pill font-weight-bold text-dark px-3 py-1 shadow-sm"
                                data-toggle="modal" data-target="#ktaModal" style="font-size: 0.85rem;">
                                <i class="fas fa-id-card mr-1"></i> Kartu Anggota (KTA)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($formulir)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="m-0 font-weight-bold text-dark"><i class="fas fa-file-alt text-success mr-2"></i> Formulir
                            Pendaftaran Saya</h4>
                        <a href="{{ route('profil-pengguna.index') }}"
                            class="btn btn-outline-primary btn-sm rounded-pill font-weight-bold px-3">
                            <i class="fas fa-user-circle mr-1"></i> Lihat di Profil Saya
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Nama Panggilan</small>
                                <span class="text-dark font-weight-bold"
                                    style="font-size: 1.05rem;">{{ $formulir->nama_panggilan }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Asal Sekolah</small>
                                <span class="text-dark font-weight-bold"
                                    style="font-size: 1.05rem;">{{ $formulir->asal_sekolah }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Tinggi / Berat Badan</small>
                                <span class="text-dark font-weight-bold"
                                    style="font-size: 1.05rem;">{{ $formulir->tinggi_badan }} cm / {{ $formulir->berat_badan }}
                                    kg</span>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Pengalaman PBB (SMP/MTs)</small>
                                <span class="badge badge-info px-3 py-2 rounded-pill font-weight-bold"
                                    style="font-size: 0.85rem;">{{ $formulir->opsi_pilihan === 'YA' ? 'Pernah (YA)' : 'Belum (TIDAK)' }}</span>
                            </div>
                        </div>

                        <div class="row mt-2 pt-3 border-top">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Tempat, Tgl Lahir</small>
                                <span class="text-dark">{{ $formulir->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($formulir->tanggal_lahir)->format('d M Y') }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Kontak (WhatsApp)</small>
                                <span class="text-dark"><i class="fab fa-whatsapp text-success mr-1"></i>
                                    {{ $formulir->no_hp }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Periode Angkatan</small>
                                <span class="text-dark"><i class="fas fa-calendar-check text-primary mr-1"></i> Tahun
                                    {{ $formulir->tahun_periode }}</span>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <small class="text-muted d-block font-weight-bold">Status Pendaftaran</small>
                                <span class="badge badge-success px-3 py-1 rounded-pill"><i
                                        class="fas fa-check-circle mr-1"></i> Diterima / Anggota</span>
                            </div>
                        </div>

                        @if(isset($kriterias) && $kriterias->count() > 0)
                            <div class="mt-3 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="font-weight-bold text-dark m-0"><i class="fas fa-award text-warning mr-2"></i>
                                        Ringkasan Nilai & Status Kelulusan Seleksi</h6>
                                    @php
                                        $totalAkhir = 0;
                                        foreach ($kriterias as $k) {
                                            $h = $formulir->hasilSeleksi->where('jenis_seleksi', $k->nama)->first();
                                            $totalAkhir += floatval($h->nilai ?? 0) * ($k->bobot / 100);
                                        }
                                    @endphp
                                    <span class="badge badge-primary px-3 py-2 rounded-pill font-weight-bold"
                                        style="font-size: 0.9rem;">
                                        Nilai Akhir: {{ number_format($totalAkhir, 2) }} / 100
                                    </span>
                                </div>
                                <div class="row">
                                    @foreach($kriterias as $k)
                                        @php
                                            $hasilK = $formulir->hasilSeleksi->where('jenis_seleksi', $k->nama)->first();
                                            $nilaiK = $hasilK ? floatval($hasilK->nilai) : 0;
                                            $isLulusK = $hasilK && $hasilK->status_lulus === 'lulus';
                                        @endphp
                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <div class="p-3 border rounded bg-light">
                                                <small class="text-muted d-block font-weight-bold text-truncate">{{ $k->nama }}
                                                    ({{ $k->bobot }}%)</small>
                                                <div class="d-flex justify-content-between align-items-center mt-1">
                                                    <span class="font-weight-bold text-dark"
                                                        style="font-size: 1.1rem;">{{ number_format($nilaiK, 1) }}</span>
                                                    @if($hasilK)
                                                        @if($isLulusK)
                                                            <span class="badge badge-success px-2 py-1 small">Lulus</span>
                                                        @else
                                                            <span class="badge badge-danger px-2 py-1 small">Tidak Lulus</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-secondary px-2 py-1 small">-</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <!-- Jadwal Mendatang -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-dark"><i class="fas fa-calendar-alt text-primary mr-2"></i> Jadwal
                        Kegiatan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mt-2">
                        @forelse($jadwalMendatang as $jadwal)
                            <li class="list-group-item px-0 border-bottom-0 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="bg-light rounded p-3 text-center mr-3" style="min-width: 70px;">
                                        <span class="d-block font-weight-bold text-primary"
                                            style="font-size: 1.2rem;">{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d') }}</span>
                                        <span
                                            class="d-block text-muted small">{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->translatedFormat('M') }}</span>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold text-dark mb-1">{{ $jadwal->nama_kegiatan }}</h6>
                                        <p class="text-muted small mb-1"><i class="far fa-clock mr-1"></i>
                                            {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</p>
                                        <p class="text-muted small mb-0"><i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $jadwal->tempat }}</p>
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
                    <h4 class="m-0 font-weight-bold text-dark"><i class="fas fa-bullhorn text-warning mr-2"></i> Informasi
                        Terbaru</h4>
                </div>
                <div class="card-body">
                    <div class="mt-2">
                        @forelse($beritaTerbaru as $berita)
                            <div class="mb-3 pb-3 border-bottom">
                                <h6 class="font-weight-bold text-dark mb-1">{{ $berita->judul }}</h6>
                                <p class="text-muted small mb-2"><i class="far fa-clock mr-1"></i>
                                    {{ $berita->created_at->diffForHumans() }}</p>
                                <p class="text-secondary small mb-0"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
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

    <!-- Modal Kartu Tanda Anggota (KTA) Digital -->
    <div class="modal fade" id="ktaModal" tabindex="-1" role="dialog" aria-labelledby="ktaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
                <div
                    class="modal-header bg-dark text-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="modal-title font-weight-bold mb-0" id="ktaModalLabel">
                        <i class="fas fa-id-card text-warning mr-2"></i> Kartu Tanda Anggota (KTA) Digital
                    </h5>
                    <button type="button" class="close text-white opacity-100" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 bg-light text-center">

                    <div id="ktaPrintArea" class="d-flex flex-column align-items-center">
                        <!-- KTA Depan (Front Card) -->
                        <div class="kta-card shadow-lg text-left position-relative mb-3"
                            style="width: 480px; max-width: 100%; height: 280px; border-radius: 18px; background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #1e3a8a 100%); color: white; padding: 22px; box-shadow: 0 15px 35px rgba(0,0,0,0.35) !important; border: 2px solid #fbbf24; overflow: hidden;">

                            <!-- Watermark Pattern -->
                            <div class="position-absolute"
                                style="right: -40px; bottom: -40px; opacity: 0.12; pointer-events: none;">
                                <img src="{{ asset('images/logo.webp') }}" style="width: 280px; height: auto;">
                            </div>

                            <!-- KTA Header -->
                            <div class="d-flex align-items-center justify-content-between pb-2 mb-3"
                                style="border-bottom: 1px dashed rgba(251, 191, 36, 0.5);">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/sman1ptk-logo.webp') }}" style="height: 40px; width: auto;"
                                        class="mr-2">
                                    <div>
                                        <h6 class="font-weight-bold mb-0 text-uppercase text-warning"
                                            style="font-size: 0.78rem; letter-spacing: 0.8px;">PASKIBRA GANESHA</h6>
                                        <small class="d-block text-light"
                                            style="font-size: 0.65rem; opacity: 0.9; letter-spacing: 0.3px;">SMA NEGERI 1
                                            PONTIANAK</small>
                                    </div>
                                </div>
                                <img src="{{ asset('images/logo.webp') }}" style="height: 40px; width: auto;">
                            </div>

                            <!-- KTA Body -->
                            <div class="row align-items-center mt-2">
                                <div class="col-4 text-center">
                                    <div class="position-relative d-inline-block">
                                        @if(auth()->user()->foto)
                                            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                                alt="{{ auth()->user()->nama_lengkap }}" class="rounded-circle shadow"
                                                style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #fbbf24; margin: 0 auto; display: block;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-white font-weight-bold shadow"
                                                style="width: 80px; height: 80px; font-size: 2rem; color: #1e3a8a; border: 3px solid #fbbf24; margin: 0 auto;">
                                                {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="position-absolute bg-success rounded-circle d-flex align-items-center justify-content-center shadow"
                                            style="width: 22px; height: 22px; bottom: 2px; right: 2px; border: 2px solid white;">
                                            <i class="fas fa-check text-white" style="font-size: 0.6rem;"></i>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning text-dark font-weight-bold mt-2 d-block mx-auto"
                                        style="font-size: 0.62rem; border-radius: 10px; width: fit-content; padding: 4px 10px;">ANGGOTA
                                        RESMI</span>
                                </div>
                                <div class="col-8 pl-1">
                                    <h6 class="font-weight-bold text-white mb-1 text-truncate"
                                        style="font-size: 1rem; letter-spacing: 0.3px;">
                                        {{ strtoupper(auth()->user()->nama_lengkap) }}
                                    </h6>
                                    <p class="mb-1 text-warning font-weight-bold" style="font-size: 0.78rem;">
                                        NO. KTA:
                                        KTA-{{ auth()->user()->formulirPendaftaran->tahun_periode ?? date('Y') }}/00{{ auth()->user()->id }}
                                    </p>
                                    <div style="font-size: 0.73rem; opacity: 0.95;" class="text-light">
                                        <div class="mb-1"><i class="fas fa-id-badge text-warning mr-1"
                                                style="width: 14px;"></i> NISN:
                                            <strong>{{ auth()->user()->nisn ?? '-' }}</strong></div>
                                        <div class="mb-1 text-truncate"><i class="fas fa-school text-warning mr-1"
                                                style="width: 14px;"></i>
                                            {{ auth()->user()->formulirPendaftaran->asal_sekolah ?? 'SMA Negeri 1 Pontianak' }}
                                        </div>
                                        <div><i class="fas fa-medal text-warning mr-1" style="width: 14px;"></i>
                                            Angkatan: <strong>{{ \App\Helpers\RomanHelper::getAngkatanRomawi(auth()->user()->formulirPendaftaran->tahun_periode ?? date('Y')) }}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <!-- KTA Footer -->
                            <div class="position-absolute d-flex justify-content-between align-items-end"
                                style="bottom: 14px; left: 22px; right: 22px;">
                                <small class="text-light" style="font-size: 0.6rem; opacity: 0.8;"><i
                                        class="fas fa-shield-alt text-warning mr-1"></i> Card Verification Token
                                    Signed</small>
                                <div class="bg-white p-1 rounded shadow-sm">
                                    <i class="fas fa-qrcode text-dark" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="button" onclick="window.print()"
                            class="btn btn-warning font-weight-bold rounded-pill px-4 shadow-sm text-dark">
                            <i class="fas fa-print mr-2"></i> Cetak / Simpan KTA (Print / PDF)
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden !important;
            }

            #ktaPrintArea,
            #ktaPrintArea * {
                visibility: visible !important;
            }

            #ktaPrintArea {
                position: fixed !important;
                left: 50% !important;
                top: 30% !important;
                transform: translate(-50%, -50%) !important;
                width: 100% !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
        }
    </style>
@endsection