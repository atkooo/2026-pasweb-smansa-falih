@extends('layouts.admin')

@section('title', 'Data Pendaftar - Paskibra')

@section('page-title', 'Data Peserta Seleksi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <i class="fas fa-users text-primary mb-3" style="font-size: 4rem; opacity: 0.8;"></i>
                <h4 class="font-weight-bold text-dark">Daftar Rekan Peserta</h4>
                <p class="text-muted">Halaman ini akan menampilkan daftar peserta lain yang juga mengikuti seleksi penerimaan anggota Paskibra tahun ini.</p>
                <div class="alert alert-info mt-4 text-left" role="alert">
                    <i class="fas fa-info-circle mr-2"></i> <strong>Pemberitahuan:</strong> Fitur ini sedang dalam tahap pengembangan.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
