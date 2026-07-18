@extends('layouts.admin')

@section('title', 'Detail Seleksi - Paskibra')

@section('page-title', 'Hasil Seleksi')

@section('content')
<!-- Red Banner -->
<div class="card border-0 mb-4 shadow-sm" style="background-color: #cc0000; border-radius: 1rem;">
    <div class="card-body p-4 p-md-5 d-flex align-items-center">
        <!-- Avatar -->
        <div class="mr-4">
            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center text-danger font-weight-bold" 
                 style="width: 100px; height: 100px; font-size: 2.5rem; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
            </div>
        </div>
        
        <!-- User Info -->
        <div>
            <h3 class="font-weight-bold text-white mb-1" style="letter-spacing: 0.5px; text-transform: uppercase;">
                {{ auth()->user()->nama_lengkap }}
            </h3>
            <h6 class="text-white mb-1" style="font-weight: 500; text-transform: uppercase;">
                {{ auth()->user()->formulirPendaftaran->asal_sekolah ?? 'SMAN 1 PONTIANAK' }}
            </h6>
            <h6 class="text-white mb-0" style="font-weight: 500; font-size: 0.85rem; opacity: 0.9;">PROVINSI KALIMANTAN BARAT</h6>
        </div>
    </div>
</div>

<!-- Content Card -->
<div class="card shadow-sm border-0" style="border-radius: 1rem;">
    <div class="card-body p-4 p-md-5">
        
        <h5 class="font-weight-bold text-dark mb-4 text-center" style="letter-spacing: 0.5px;">{{ $stage['title'] }}</h5>
        
        <div class="d-flex justify-content-center mb-5">
            @if($stage['status'] === 'LOLOS')
                <div class="px-5 py-2 font-weight-bold rounded-pill text-success text-center" style="background-color: #dcfce7; min-width: 150px;">
                    LOLOS
                </div>
            @elseif($stage['score'])
                <div class="px-5 py-2 font-weight-bold rounded-pill text-center" style="background-color: #fff7ed; color: #ea580c; min-width: 150px;">
                    NILAI: {{ $stage['score'] }}
                </div>
            @else
                <div class="px-5 py-2 font-weight-bold rounded-pill text-secondary text-center" style="background-color: #f3f4f6; min-width: 150px;">
                    BELUM DINILAI
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="p-4 rounded" style="background-color: #f8f9fa;">
                    <p class="text-muted mb-1 small">Tanggal Seleksi</p>
                    <h6 class="font-weight-bold text-dark mb-0">{{ $stage['date'] }}</h6>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-4 rounded" style="background-color: #f8f9fa;">
                    <p class="text-muted mb-1 small">Sesi</p>
                    <h6 class="font-weight-bold text-dark mb-0">Sesi 1</h6>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-4 rounded" style="background-color: #f8f9fa;">
                    <p class="text-muted mb-1 small">Nilai</p>
                    <h6 class="font-weight-bold text-dark mb-0">{{ $stage['score'] ?? '-' }}</h6>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-4 rounded" style="background-color: #f8f9fa;">
                    <p class="text-muted mb-1 small">Wilayah</p>
                    <h6 class="font-weight-bold text-dark mb-0">Provinsi</h6>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('status-seleksi.index') }}" class="btn btn-outline-secondary px-4 rounded-pill font-weight-bold">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
