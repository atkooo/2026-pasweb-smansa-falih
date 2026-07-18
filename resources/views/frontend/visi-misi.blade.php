@extends("layouts.app")

@section("title", "Visi & Misi - Paskibra Ganesha")

@section("content")
<style>
    .red-pattern-bg {
        background: linear-gradient(135deg, #d10000 0%, #a00000 100%);
        position: relative;
        box-shadow: inset 0 10px 20px rgba(0,0,0,0.1);
    }
    .red-pattern-bg::before {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.06) 0%, transparent 40%),
                          radial-gradient(circle at 80% 90%, rgba(255,255,255,0.04) 0%, transparent 50%);
        pointer-events: none;
    }
    .misi-card {
        border-radius: 16px !important;
        border: 1.5px solid rgba(209, 0, 0, 0.4) !important;
        background: #fffcfc;
        box-shadow: 0 6px 15px rgba(209, 0, 0, 0.06) !important;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .misi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: #d10000;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    .misi-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(209, 0, 0, 0.15) !important;
        border-color: #d10000 !important;
        background: #ffffff;
    }
    .misi-card:hover::before {
        transform: scaleX(1);
    }
</style>

<!-- CSS Breakout to escape container-lg -->
<div style="margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); margin-top: -1.5rem; background-color: #f8f9fa;">

    <!-- Top Title Section -->
    <div class="text-center bg-white" style="padding: 2.5rem 0 1.5rem;">
        <h2 class="fw-bold mb-2" style="font-size: 2.5rem; letter-spacing: 1px; color: #212529;">VISI & MISI</h2>
        <h3 class="fw-bold" style="color: #d10000; font-size: 1.8rem; letter-spacing: 0.5px;">PASKIBRA SMA NEGERI 1 PONTIANAK</h3>
    </div>

    <!-- Visi Section (Red Background) -->
    <div class="red-pattern-bg" style="padding: 3.5rem 0;">
        <div class="container px-4 px-md-5 position-relative z-1" style="max-width: 1200px;">
            <div class="row align-items-center">
                @if(isset($informasi['gambar_visi']))
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <img src="{{ asset($informasi['gambar_visi']) }}" alt="Visi Paskibra" style="width: 230px; height: 300px; object-fit: cover; border-radius: 50% / 50%; border: 12px solid #fff; box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
                </div>
                <div class="col-md-8 ps-md-5">
                @else
                <div class="col-md-12 text-center text-md-start">
                @endif
                    <h2 class="fw-bold mb-3" style="color: #ffffff; font-size: 3.2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">VISI</h2>
                    <p style="font-size: 1.25rem; line-height: 1.8; color: rgba(255,255,255,0.95); text-align: justify; margin-bottom: 0;">
                        {!! nl2br(e($informasi['visi'] ?? 'Mewujudkan Paskibra Ganesha sebagai wadah pembinaan yang meningkatkan kedisiplinan, berintegritas, saling mendukung, serta semakin berkembang dengan meningkatkan prestasi yang menjunjung tinggi nilai cinta tanah air.')) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Misi Section -->
    <div class="bg-white" style="padding: 3.5rem 0 4rem;">
        <div class="container px-4 px-md-5" style="max-width: 1200px;">
            <div class="text-center mb-4">
                <h2 class="fw-bold d-inline-block position-relative" style="font-size: 2.8rem; color: #212529;">
                    MISI
                    <div style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background-color: #d10000; border-radius: 2px;"></div>
                </h2>
            </div>
            
            <div class="row justify-content-center g-4 mt-1">
                @php
                    $defaultMisi = "Menjadikan Paskibra Ganesha sebagai organisasi yang semakin aktif dan berprestasi baik internal maupun eksternal sekolah.\nMemberikan ruang untuk anggota Paskibra Ganesha mengembangkan potensi diri baik secara fisik, mental, serta jiwa kepemimpinan.\nMenjaga nama baik Paskibra Ganesha dengan menunjukkan sikap sopan, disiplin dan bertanggung jawab.\nMengadakan sistem evaluasi berkala untuk melihat perkembangan serta kinerja anggota Paskibra Ganesha\nMembangun komunikasi dan hubungan yang baik antara anggota Paskibra Ganesha dengan sekolah, pembina serta pelatih dan organisasi lainnya.";
                    $misiText = $informasi['misi'] ?? $defaultMisi;
                    $misiArray = array_filter(array_map('trim', explode("\n", $misiText)));
                @endphp

                @foreach($misiArray as $misiItem)
                <div class="col-md-4">
                    <div class="card h-100 p-4 border-0 misi-card">
                        <p class="mb-0 text-dark" style="font-size: 1.1rem; line-height: 1.7;">{{ $misiItem }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
