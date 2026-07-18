@extends('layouts.admin')

@section('title', 'Laporan Statistik')

@section('extra-css')
<style>
    .stat-card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .print-only {
        display: none;
    }
    
    body.dark-mode .stat-card {
        background-color: #1f2937;
    }
    body.dark-mode .card {
        background-color: #1f2937;
        color: #f9fafb;
    }
    body.dark-mode .table td, body.dark-mode .table th {
        border-color: #374151;
        color: #e5e7eb;
    }

    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .main-sidebar, .main-header, .no-print, .btn, footer {
            display: none !important;
        }
        .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            background-color: white !important;
        }
        .print-only {
            display: block !important;
            text-align: center;
            margin-bottom: 2rem;
        }
        .stat-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        .table {
            border: 1px solid #ddd;
        }
    }
</style>
@endsection

@section('content')
<div class="print-only">
    <h2>Laporan Data Paskibra Ganesha</h2>
    <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    <hr>
</div>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2 no-print">
    <div>
        <h3 class="font-weight-bold" style="letter-spacing: -0.5px; margin-bottom: 0.2rem;">Laporan & Statistik</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Ringkasan keseluruhan data Paskibra Ganesha.</p>
    </div>
    <div>
        <button onclick="window.print()" class="btn px-4 py-2" style="background-color: #4b5563; color: white; border-radius: 50rem; font-weight: 600;">
            <i class="fas fa-print mr-2"></i> Cetak Laporan
        </button>
    </div>
</div>

<div class="row">
    <!-- Pengguna -->
    <div class="col-md-3 mb-4">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="ml-3">
                    <h5 class="font-weight-bold mb-0" style="font-size: 1.5rem;">{{ $stats['total_admin'] + $stats['total_pengurus'] }}</h5>
                    <span class="text-muted" style="font-size: 0.9rem;">Total Pengurus</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Calon Anggota -->
    <div class="col-md-3 mb-4">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="ml-3">
                    <h5 class="font-weight-bold mb-0" style="font-size: 1.5rem;">{{ $stats['total_calon'] }}</h5>
                    <span class="text-muted" style="font-size: 0.9rem;">Calon Anggota</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Berita -->
    <div class="col-md-3 mb-4">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="ml-3">
                    <h5 class="font-weight-bold mb-0" style="font-size: 1.5rem;">{{ $stats['total_berita'] }}</h5>
                    <span class="text-muted" style="font-size: 0.9rem;">Total Berita</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Foto Galeri -->
    <div class="col-md-3 mb-4">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    <i class="fas fa-images"></i>
                </div>
                <div class="ml-3">
                    <h5 class="font-weight-bold mb-0" style="font-size: 1.5rem;">{{ $stats['total_foto'] }}</h5>
                    <span class="text-muted" style="font-size: 0.9rem;">Foto Galeri</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card stat-card">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="font-weight-bold"><i class="fas fa-calendar-check mr-2 text-primary"></i> Jadwal Kegiatan Bulan Ini ({{ \Carbon\Carbon::now()->translatedFormat('F Y') }})</h5>
            </div>
            <div class="card-body">
                @if($jadwalBulanIni->isEmpty())
                    <p class="text-muted text-center py-3">Tidak ada jadwal kegiatan untuk bulan ini.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tempat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalBulanIni as $index => $jadwal)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} WIB</td>
                                    <td class="font-weight-bold">{{ $jadwal->nama_kegiatan }}</td>
                                    <td>{{ $jadwal->tempat }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
