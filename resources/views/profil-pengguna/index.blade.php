@extends('layouts.admin')

@section('title', 'Profil Pengguna - Paskibra Ganesha')

@section('page-title', 'Profil Pengguna')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5 mb-4">
        <div class="card shadow-sm border-0" style="border-radius: 1rem;">
            <div class="card-body text-center pt-5 pb-5">
                <div class="mb-4 d-flex justify-content-center">
                    <div style="width: 120px; height: 120px; border-radius: 50%; background-color: #f8f9fa; border: 4px solid #e9ecef; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; color: #adb5bd;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <h4 class="font-weight-bold text-dark mb-2">{{ $user->nama_lengkap }}</h4>
                <p class="text-muted mb-3" style="font-size: 1rem;">
                    @if($user->role === 'admin')
                        <span class="badge badge-danger px-4 py-2 rounded-pill" style="font-size: 0.9rem;">Administrator</span>
                    @elseif($user->role === 'pengurus')
                        <span class="badge badge-primary px-4 py-2 rounded-pill" style="font-size: 0.9rem;">Pengurus</span>
                    @else
                        <span class="badge badge-info px-4 py-2 rounded-pill" style="font-size: 0.9rem;">Calon Anggota</span>
                    @endif
                </p>
                
                <div class="mt-4 pt-3 border-top text-left px-3">
                    <div class="d-flex mb-3">
                        <div class="mr-3 text-primary" style="font-size: 1.25rem; width: 30px; text-center;">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 font-weight-bold text-dark">Username</h6>
                            <p class="text-muted mb-0">{{ $user->username }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="mr-3 text-primary" style="font-size: 1.25rem; width: 30px; text-center;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 font-weight-bold text-dark">Email</h6>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="mr-3 text-primary" style="font-size: 1.25rem; width: 30px; text-center;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 font-weight-bold text-dark">Bergabung Sejak</h6>
                            <p class="text-muted mb-0">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="{{ route('pengaturan.index') }}" class="btn btn-outline-primary rounded-pill px-4 font-weight-bold">
                        <i class="fas fa-cog mr-2"></i> Pengaturan Akun
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
