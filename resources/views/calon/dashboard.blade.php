@extends('layouts.admin')

@section('title', 'Dashboard Calon Anggota - Paskibra Ganesha')

@section('content')
    <!-- CALON ANGGOTA DASHBOARD -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center mb-4 mb-md-0">
                            <!-- Avatar -->
                            <div class="position-relative mr-4 mr-md-5">
                                @if(auth()->user()->foto)
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="{{ auth()->user()->nama_lengkap }}" class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #ef4444;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold calon-avatar">
                                        {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Profile Data -->
                            <div>
                                <h3 class="font-weight-bold mb-1 calon-name">
                                    {{ auth()->user()->nama_lengkap }}
                                </h3>
                                <h6 class="mb-4 calon-role-title">Calon Anggota Paskibra SMA Negeri 1 Pontianak</h6>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-user mt-1 mr-3 text-danger info-icon"></i>
                                    <div>
                                        <p class="text-muted mb-0 dashboard-subtitle">NISN / NIK</p>
                                        <p class="font-weight-bold mb-0 text-dark">{{ auth()->user()->nisn ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-map-marker-alt mt-1 mr-3 text-danger info-icon"></i>
                                    <div>
                                        <p class="text-muted mb-0 dashboard-subtitle">Alamat</p>
                                        <p class="font-weight-bold mb-0 text-dark">
                                            @php
                                                $formulir = auth()->user()->formulirPendaftaran;
                                                echo $formulir ? strtoupper($formulir->alamat) : 'BELUM DIISI';
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-phone mt-1 mr-3 text-danger info-icon"></i>
                                    <div>
                                        <p class="text-muted mb-0 dashboard-subtitle">Phone</p>
                                        <p class="font-weight-bold mb-0 text-dark">{{ auth()->user()->formulirPendaftaran?->no_hp ?? (auth()->user()->no_hp ?? 'Belum diisi') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center" style="border-left: 1px solid #f0f0f0;">
                            <img src="{{ asset('images/logo.webp') }}" alt="Logo Paskibra" style="width: 160px; height: auto;" class="mb-3">
                            <h6 class="font-weight-bold text-secondary" style="text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
                                Paskibra Ganesha<br>SMA Negeri 1 Pontianak
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Content (Bottom Clipboard Card) -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                    <i class="fas fa-clipboard-check text-success mb-3" style="font-size: 6rem; opacity: 0.7;"></i>
                    <h3 class="font-weight-bold text-dark mb-3">Selamat Datang di Portal Calon Anggota</h3>
                    @if($formulir = auth()->user()->formulirPendaftaran)
                        @if($formulir->status_pendaftaran === 'approved')
                            <div class="w-100 mb-3 text-left p-4 rounded-lg" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); box-shadow: 0 8px 24px rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.15);">
                                <div class="d-flex align-items-start">
                                    <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 6px 16px rgba(16,185,129,0.35);">
                                        <i class="fas fa-check text-white" style="font-size:1.3rem;"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#10b981,#059669);font-size:0.72rem;letter-spacing:1px;padding:4px 12px;">✓ DISETUJUI</span>
                                        <h6 class="font-weight-bold text-dark mb-1">Selamat! Berkas Pendaftaran Anda Telah Disetujui</h6>
                                        <p class="text-muted small mb-0">Berkas Anda telah diverifikasi oleh tim Pengurus. Silakan pantau informasi seleksi lebih lanjut.</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($formulir->status_pendaftaran === 'revision')
                            <div class="w-100 mb-3 text-left p-4 rounded-lg" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); box-shadow: 0 8px 24px rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.15);">
                                <div class="d-flex align-items-start">
                                    <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 6px 16px rgba(245,158,11,0.35);">
                                        <i class="fas fa-pen text-white" style="font-size:1.1rem;"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#f59e0b,#d97706);font-size:0.72rem;letter-spacing:1px;padding:4px 12px;">✎ PERLU REVISI</span>
                                        <h6 class="font-weight-bold text-dark mb-1">Perlu Revisi Berkas Pendaftaran</h6>
                                        <p class="text-muted small mb-1">Catatan Pengurus: <em>"{{ $formulir->catatan_verifikasi ?: 'Mohon periksa kembali kelengkapan formulir Anda.' }}"</em></p>
                                        <a href="{{ route('pendaftaran.edit') }}" class="btn btn-sm btn-warning text-white rounded-pill font-weight-bold mt-1"><i class="fas fa-edit mr-1"></i> Update Berkas</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="w-100 mb-3 text-left p-4 rounded-lg" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); box-shadow: 0 8px 24px rgba(59,130,246,0.10); border: 1px solid rgba(59,130,246,0.15);">
                                <div class="d-flex align-items-start">
                                    <div class="mr-4 shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:linear-gradient(135deg,#3b82f6,#2563eb);box-shadow:0 6px 16px rgba(59,130,246,0.30);">
                                        <i class="fas fa-hourglass-half text-white" style="font-size:1.1rem;"></i>
                                    </div>
                                    <div class="text-left">
                                        <span class="badge badge-pill mb-2 text-white" style="background:linear-gradient(135deg,#3b82f6,#2563eb);font-size:0.72rem;letter-spacing:1px;padding:4px 12px;">⏳ DALAM REVIEW</span>
                                        <h6 class="font-weight-bold text-dark mb-1">Formulir Dalam Tahap Pemeriksaan (Review)</h6>
                                        <p class="text-muted small mb-0">Formulir pendaftaran Anda sudah diterima dan saat ini dalam proses pemeriksaan berkas oleh tim Pengurus.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <p class="text-muted" style="font-size: 1.05rem;">Terima kasih, Anda telah mengisi formulir pendaftaran. Anda dapat melihat detail form Anda melalui menu "Formulir" di sebelah kiri.</p>
                    @else
                        @php
                            $statusInfo = \App\Models\Informasi::where('jenis_info', 'pendaftaran_status')->first();
                        @endphp
                        @if($statusInfo && $statusInfo->konten === 'tutup')
                            <p class="text-danger font-weight-bold" style="font-size: 1.1rem;">
                                <i class="fas fa-ban mr-2"></i> Mohon maaf, masa pendaftaran calon anggota baru saat ini sedang ditutup.
                            </p>
                        @else
                            <p class="text-muted" style="font-size: 1.1rem;">Lengkapi formulir pendaftaran Anda dan pantau status kelulusan melalui menu di sebelah kiri.</p>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-primary mt-3 px-4 py-2 font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-edit mr-2"></i> Isi Formulir Pendaftaran
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
