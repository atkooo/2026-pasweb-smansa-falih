@extends('layouts.admin')

@section('title', 'Dashboard Calon Anggota - Paskibra Ganesha')

@section('content')
    <!-- CALON ANGGOTA DASHBOARD -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <!-- Left Side: Profile Info -->
                        <div class="col-md-8 d-flex align-items-center mb-4 mb-md-0">
                            <!-- Avatar -->
                            <div class="position-relative mr-4 mr-md-5">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold calon-avatar" 
                                     >
                                    {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                                </div>
                                <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center shadow calon-avatar-badge" 
                                     >
                                    <i class="fas fa-plus text-secondary" ></i>
                                </div>
                            </div>
                            
                            <!-- Profile Data -->
                            <div>
                                <h3 class="font-weight-bold mb-1 calon-name" >
                                    {{ auth()->user()->nama_lengkap }}
                                </h3>
                                <h6 class="mb-4 calon-role-title" >Calon Anggota Paskibra SMA Negeri 1 Pontianak</h6>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-user mt-1 mr-3 text-danger info-icon" ></i>
                                    <div>
                                        <p class="text-muted mb-0 dashboard-subtitle" >NISN / NIK</p>
                                        <p class="font-weight-bold mb-0 text-dark">{{ auth()->user()->username ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-3">
                                    <i class="fas fa-map-marker-alt mt-1 mr-3 text-danger info-icon" ></i>
                                    <div>
                                        <p class="text-muted mb-0 dashboard-subtitle" >Alamat</p>
                                        <p class="font-weight-bold mb-0 text-dark">
                                            @php
                                                $formulir = auth()->user()->formulirPendaftaran;
                                                echo $formulir ? strtoupper($formulir->alamat) : 'BELUM DIISI';
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-phone mt-1 mr-3 text-danger info-icon" ></i>
                                    <div>
                                        <p class="text-muted mb-0 dashboard-subtitle" >Phone</p>
                                        <p class="font-weight-bold mb-0 text-dark">{{ auth()->user()->no_hp ?? 'Belum diisi' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Badge / Logo -->
                        <div class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center" style="border-left: 1px solid #f0f0f0;">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Paskibra" style="width: 160px; height: auto;" class="mb-3">
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
                    <h3 class="font-weight-bold text-dark mb-2">Selamat Datang di Portal Calon Anggota</h3>
                    @if(auth()->user()->formulirPendaftaran)
                        <p class="text-muted" style="font-size: 1.1rem;">Terima kasih, Anda telah mengisi formulir pendaftaran. Anda dapat melihat detail form Anda melalui menu "Formulir" di sebelah kiri.</p>
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
                            <a href="{{ route('formulir.index') }}" class="btn btn-primary mt-3 px-4 py-2 font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-edit mr-2"></i> Isi Formulir Pendaftaran
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
