@extends('layouts.admin')

@section('title', 'Data Pendaftar - Paskibra')

@section('page-title', 'Data Peserta Seleksi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-header bg-white border-bottom pt-4 pb-3">
                <h6 class="font-weight-bold text-dark mb-0" style="text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="fas fa-users mr-2 text-primary"></i> Daftar Rekan Peserta
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th scope="col" class="border-0 pl-4 py-3 font-weight-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">No</th>
                                <th scope="col" class="border-0 py-3 font-weight-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Nama Peserta</th>
                                <th scope="col" class="border-0 py-3 font-weight-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Asal Sekolah</th>
                                <th scope="col" class="border-0 py-3 font-weight-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Jenis Kelamin</th>
                                <th scope="col" class="border-0 pr-4 py-3 font-weight-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Status Berkas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesertas as $index => $peserta)
                                <tr>
                                    <td class="pl-4 py-3 text-muted">{{ $index + 1 }}</td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 text-white d-flex align-items-center justify-content-center font-weight-bold" 
                                                 style="width: 40px; height: 40px; border-radius: 50%; background-color: {{ $peserta->jenis_kelamin == 'L' ? '#4e73df' : '#e83e8c' }};">
                                                {{ substr($peserta->user->nama_lengkap, 0, 1) }}
                                            </div>
                                            <div>
                                                <h6 class="mb-0 font-weight-bold text-dark">{{ $peserta->user->nama_lengkap }}</h6>
                                                <small class="text-muted">{{ $peserta->nama_panggilan ? 'Panggilan: ' . $peserta->nama_panggilan : '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 text-muted font-weight-500">
                                        <i class="fas fa-school mr-1 text-secondary"></i> {{ $peserta->asal_sekolah }}
                                    </td>
                                    <td class="py-3">
                                        @if($peserta->jenis_kelamin == 'L')
                                            <span class="badge badge-primary px-3 py-1 rounded-pill"><i class="fas fa-mars mr-1"></i> Laki-laki</span>
                                        @else
                                            <span class="badge badge-danger px-3 py-1 rounded-pill" style="background-color: #e83e8c;"><i class="fas fa-venus mr-1"></i> Perempuan</span>
                                        @endif
                                    </td>
                                    <td class="pr-4 py-3">
                                        @if($peserta->status_pendaftaran == 'approved')
                                            <span class="text-success font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Terverifikasi</span>
                                        @elseif($peserta->status_pendaftaran == 'pending')
                                            <span class="text-warning font-weight-bold"><i class="fas fa-clock mr-1"></i> Menunggu Verifikasi</span>
                                        @elseif($peserta->status_pendaftaran == 'revision')
                                            <span class="text-info font-weight-bold"><i class="fas fa-exclamation-circle mr-1"></i> Revisi Berkas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-users-slash mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                                            <h5>Belum ada rekan peserta</h5>
                                            <p>Belum ada data pendaftar yang tersedia saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top text-muted small py-3">
                <i class="fas fa-info-circle mr-1 text-primary"></i> Data di atas hanya menampilkan peserta yang berkasnya sedang diproses atau telah diverifikasi.
            </div>
        </div>
    </div>
</div>
@endsection
