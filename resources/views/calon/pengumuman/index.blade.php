@extends('layouts.admin')

@section('title', 'Pengumuman Seleksi - Paskibra')

@section('page-title', 'Pengumuman Resmi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <i class="fas fa-bullhorn text-warning mb-3" style="font-size: 4rem; opacity: 0.8;"></i>
                <h4 class="font-weight-bold text-dark">Papan Pengumuman</h4>
                <p class="text-muted">Halaman ini digunakan untuk melihat semua pengumuman resmi terkait jadwal seleksi, pengarahan, maupun hasil kelulusan akhir.</p>
                <div class="alert alert-info mt-4 text-left" role="alert">
                    <i class="fas fa-info-circle mr-2"></i> <strong>Pemberitahuan:</strong> Belum ada pengumuman baru saat ini.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
