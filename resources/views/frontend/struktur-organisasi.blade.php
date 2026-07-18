@extends("layouts.app")

@section("title", "Struktur Organisasi - Paskibra Ganesha")

@section("content")
<style>
    .hierarchy-section {
        margin-bottom: 5rem;
        position: relative;
    }
    .hierarchy-title {
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: #d10000;
        text-transform: uppercase;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hierarchy-title::before, .hierarchy-title::after {
        content: '';
        height: 2px;
        width: 50px;
        background-color: #d10000;
        margin: 0 15px;
        border-radius: 2px;
    }
    
    .org-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2rem 1.5rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .org-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
        background: #d10000;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    .org-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(209, 0, 0, 0.1);
        border-color: rgba(209, 0, 0, 0.1);
    }
    .org-card:hover::before {
        transform: scaleX(1);
    }
    
    .org-photo-wrapper {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        padding: 5px;
        background: #fff;
        border: 2px dashed #d10000;
        margin-bottom: 1.5rem;
        transition: all 0.4s ease;
    }
    .org-card:hover .org-photo-wrapper {
        border-style: solid;
        transform: rotate(5deg) scale(1.05);
    }
    
    .org-photo {
        width: 100%;
        height: 100%;
        aspect-ratio: 1/1;
        border-radius: 50%;
        object-fit: cover !important;
        object-position: top center;
        background-color: #f8f9fa;
        display: block;
    }
    .empty-photo {
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 2rem;
    }
    
    .org-role {
        font-weight: 800;
        font-size: 1.1rem;
        color: #212529;
        margin-bottom: 0.5rem;
    }
    .org-name {
        font-size: 0.95rem;
        color: #6c757d;
        font-weight: 500;
    }

    .card-ketua {
        border: 2px solid #d10000;
        box-shadow: 0 8px 25px rgba(209,0,0,0.08);
    }
    .card-ketua .org-photo-wrapper {
        width: 160px;
        height: 160px;
        border-style: solid;
        background: #fff0f0;
    }
    .card-ketua .org-role {
        font-size: 1.3rem;
        color: #d10000;
    }
</style>

<div style="background-color: #f8f9fa; min-height: 100vh; padding-top: 4rem; padding-bottom: 6rem; margin-top: -1.5rem;">
    <!-- Top Title Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2" style="font-size: 2.5rem; letter-spacing: 1px; color: #212529;">STRUKTUR ORGANISASI</h2>
        <h3 class="fw-bold" style="color: #d10000; font-size: 1.5rem; letter-spacing: 0.5px;">PASKIBRA SMA NEGERI 1 PONTIANAK</h3>
    </div>

    <div class="container px-4 px-md-5" style="max-width: 1100px;">
        @php
            $informasi = \App\Models\Informasi::pluck('konten', 'jenis_info')->toArray();
        @endphp

        @if(isset($informasi['gambar_struktur']))
            <div class="text-center mb-5">
                <img src="{{ asset($informasi['gambar_struktur']) }}" alt="Struktur Organisasi" class="img-fluid" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            </div>
        @else
        
        <!-- LEVEL 1: Pelindung & Pembina -->
        <div class="hierarchy-section">
            <div class="hierarchy-title">Dewan Pelindung & Pembina</div>
            <div class="row justify-content-center g-4">
                <div class="col-md-4 col-sm-6">
                    <div class="org-card">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_kepsek_foto']))
                                <img src="{{ asset($informasi['org_kepsek_foto']) }}" class="org-photo" alt="Kepala Sekolah">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user-tie"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Kepala Sekolah</div>
                        <div class="org-name">{{ $informasi['org_kepsek_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-nip mt-1" style="font-size: 0.85rem; color: #888;">NIP. {{ $informasi['org_kepsek_nip'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="org-card">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_pembina_foto']))
                                <img src="{{ asset($informasi['org_pembina_foto']) }}" class="org-photo" alt="Pembina Paskibra">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user-tie"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Pembina Paskibra</div>
                        <div class="org-name">{{ $informasi['org_pembina_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-nip mt-1" style="font-size: 0.85rem; color: #888;">NIP. {{ $informasi['org_pembina_nip'] ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LEVEL 2: Pengurus Inti -->
        <div class="hierarchy-section">
            <div class="hierarchy-title">Pengurus Inti</div>
            
            <!-- Ketua (Center) -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-5 col-sm-8">
                    <div class="org-card card-ketua">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_ketua_foto']))
                                <img src="{{ asset($informasi['org_ketua_foto']) }}" class="org-photo" alt="Ketua Paskibra">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Ketua Paskibra</div>
                        <div class="org-name">{{ $informasi['org_ketua_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.85rem; color: #888;">Kelas: {{ $informasi['org_ketua_kelas'] ?? '-' }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Wakil, Komandan, Sekretaris, Bendahara -->
            <div class="row justify-content-center g-4">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="org-card">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_wakil_foto']))
                                <img src="{{ asset($informasi['org_wakil_foto']) }}" class="org-photo" alt="Wakil Ketua">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Wakil Ketua</div>
                        <div class="org-name">{{ $informasi['org_wakil_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.85rem; color: #888;">Kelas: {{ $informasi['org_wakil_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="org-card">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_komandan_foto']))
                                <img src="{{ asset($informasi['org_komandan_foto']) }}" class="org-photo" alt="Komandan Angkatan">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Komandan Angkatan</div>
                        <div class="org-name">{{ $informasi['org_komandan_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.85rem; color: #888;">Kelas: {{ $informasi['org_komandan_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="org-card">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_sekretaris_foto']))
                                <img src="{{ asset($informasi['org_sekretaris_foto']) }}" class="org-photo" alt="Sekretaris">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Sekretaris</div>
                        <div class="org-name">{{ $informasi['org_sekretaris_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.85rem; color: #888;">Kelas: {{ $informasi['org_sekretaris_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="org-card">
                        <div class="org-photo-wrapper">
                            @if(isset($informasi['org_bendahara_foto']))
                                <img src="{{ asset($informasi['org_bendahara_foto']) }}" class="org-photo" alt="Bendahara">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-user"></i></div>
                            @endif
                        </div>
                        <div class="org-role">Bendahara</div>
                        <div class="org-name">{{ $informasi['org_bendahara_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.85rem; color: #888;">Kelas: {{ $informasi['org_bendahara_kelas'] ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LEVEL 3: Koordinator Divisi -->
        <div class="hierarchy-section mb-0">
            <div class="hierarchy-title">Koordinator Divisi</div>
            <div class="row justify-content-center g-4">
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="org-card" style="padding: 1.5rem 1rem;">
                        <div class="org-photo-wrapper" style="width: 90px; height: 90px;">
                            @if(isset($informasi['org_div_kesekretariatan_foto']))
                                <img src="{{ asset($informasi['org_div_kesekretariatan_foto']) }}" class="org-photo" alt="Koor Kesekretariatan">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-users"></i></div>
                            @endif
                        </div>
                        <div class="org-role" style="font-size: 0.95rem;">Kesekretariatan</div>
                        <div class="org-name" style="font-size: 0.8rem;">{{ $informasi['org_div_kesekretariatan_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.75rem; color: #888;">Kelas: {{ $informasi['org_div_kesekretariatan_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="org-card" style="padding: 1.5rem 1rem;">
                        <div class="org-photo-wrapper" style="width: 90px; height: 90px;">
                            @if(isset($informasi['org_div_acara_foto']))
                                <img src="{{ asset($informasi['org_div_acara_foto']) }}" class="org-photo" alt="Koor Acara">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-users"></i></div>
                            @endif
                        </div>
                        <div class="org-role" style="font-size: 0.95rem;">Acara</div>
                        <div class="org-name" style="font-size: 0.8rem;">{{ $informasi['org_div_acara_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.75rem; color: #888;">Kelas: {{ $informasi['org_div_acara_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="org-card" style="padding: 1.5rem 1rem;">
                        <div class="org-photo-wrapper" style="width: 90px; height: 90px;">
                            @if(isset($informasi['org_div_humas_foto']))
                                <img src="{{ asset($informasi['org_div_humas_foto']) }}" class="org-photo" alt="Koor Humas">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-users"></i></div>
                            @endif
                        </div>
                        <div class="org-role" style="font-size: 0.95rem;">Humas</div>
                        <div class="org-name" style="font-size: 0.8rem;">{{ $informasi['org_div_humas_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.75rem; color: #888;">Kelas: {{ $informasi['org_div_humas_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="org-card" style="padding: 1.5rem 1rem;">
                        <div class="org-photo-wrapper" style="width: 90px; height: 90px;">
                            @if(isset($informasi['org_div_upacara_foto']))
                                <img src="{{ asset($informasi['org_div_upacara_foto']) }}" class="org-photo" alt="Koor Upacara">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-users"></i></div>
                            @endif
                        </div>
                        <div class="org-role" style="font-size: 0.95rem;">Upacara</div>
                        <div class="org-name" style="font-size: 0.8rem;">{{ $informasi['org_div_upacara_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.75rem; color: #888;">Kelas: {{ $informasi['org_div_upacara_kelas'] ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <div class="org-card" style="padding: 1.5rem 1rem;">
                        <div class="org-photo-wrapper" style="width: 90px; height: 90px;">
                            @if(isset($informasi['org_div_latihan_foto']))
                                <img src="{{ asset($informasi['org_div_latihan_foto']) }}" class="org-photo" alt="Koor Latihan">
                            @else
                                <div class="org-photo empty-photo"><i class="fas fa-users"></i></div>
                            @endif
                        </div>
                        <div class="org-role" style="font-size: 0.95rem;">Latihan</div>
                        <div class="org-name" style="font-size: 0.8rem;">{{ $informasi['org_div_latihan_nama'] ?? 'Belum Diisi' }}</div>
                        <div class="org-kelas mt-1" style="font-size: 0.75rem; color: #888;">Kelas: {{ $informasi['org_div_latihan_kelas'] ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>
@endsection
