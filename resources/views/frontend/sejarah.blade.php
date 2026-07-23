@extends("layouts.app")

@section("title", "Sejarah - Paskibra Ganesha")

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
    .highlight-date {
        display: inline-block;
        background-color: #fff0f0;
        color: #d10000;
        padding: 0 0.4rem;
        border-radius: 4px;
        font-weight: 700;
    }
</style>

<!-- CSS Breakout to escape container-lg -->
<div style="margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); margin-top: -1.5rem; background-color: #f8f9fa;">

    <div class="px-3 px-md-4 mx-auto" style="max-width: 1040px; padding-top: 3rem;">
        <div class="card border-0 p-4 p-md-5 mb-5" style="border-radius: 1rem; background-color: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.06);">
            <div class="mb-4">
                <span class="d-inline-block text-white fw-bold px-3 py-1 mb-2 shadow-sm" style="background-color: #d10000; font-size: 0.85rem; letter-spacing: 2px; border-radius: 30px;">SEJARAH</span>
                <h2 class="fw-black mb-4" style="color: #d10000; font-size: 2.2rem; font-weight: 900; letter-spacing: 0.5px;">Paskibra SMA Negeri 1 Pontianak</h2>
            </div>

            @if(isset($informasi['gambar_sejarah']))
                <img src="{{ asset($informasi['gambar_sejarah']) }}" alt="Sejarah Paskibra" class="img-fluid w-100 mb-4" style="border-radius: 0.8rem; object-fit: cover; max-height: 500px; box-shadow: 0 8px 24px rgba(0,0,0,0.12);">
            @endif

            <div style="font-size: 1.1rem; line-height: 1.9; text-align: justify; color: #444;">
                <p>
                    {!! nl2br($informasi['sejarah_p1'] ?? '<strong>Berawal dari prestasi siswa SMA Negeri 1 Pontianak</strong> di tingkat Paskibraka, pada tahun 1991 Akhdan Wahyu terpilih sebagai Paskibraka Provinsi Kalimantan Barat. Setahun kemudian, tepatnya pada tahun 1992, Dian Astiningsih terpilih sebagai Paskibraka Nasional utusan Provinsi Kalimantan Barat, sementara Nudi Wicaksono terpilih sebagai Paskibraka Provinsi Kalimantan Barat. Berbekal pengalaman dan semangat pengabdian, ketiganya menjadi pelopor berdirinya Paskibra SMA Negeri 1 Pontianak dengan tujuan membagikan ilmu, pengalaman, serta nilai-nilai kedisiplinan kepada adik-adik mereka, sekaligus membentuk wadah pembinaan karakter, fisik, mental, dan jiwa kepemimpinan bagi siswa yang bercita-cita menjadi Paskibraka.') !!}
                </p>
                <p>
                    {!! nl2br($informasi['sejarah_p2'] ?? 'Gagasan tersebut akhirnya terwujud pada <strong>22 Februari 1993</strong>, saat Pasukan Pengibar Bendera SMA Negeri 1 Pontianak <strong>resmi didirikan</strong> dan ditandai dengan pengukuhan Angkatan I. Sejak berdiri, Paskibra SMA Negeri 1 Pontianak berada di bawah naungan OSIS dengan pembinaan dari Purna Paskibraka Indonesia (PPI), serta memiliki tujuan utama untuk meningkatkan kualitas pelaksanaan upacara bendera di sekolah, membentuk pribadi yang berkarakter, disiplin, bertanggung jawab, berjiwa nasionalisme, serta mampu mengharumkan nama sekolah melalui berbagai prestasi. Berkat kerja sama, kekompakan, dan dedikasi seluruh anggota yang didukung oleh para pembina, hingga kini Paskibra SMA Negeri 1 Pontianak terus menunjukkan eksistensinya sebagai organisasi yang solid, berprestasi, dan menjadi salah satu kebanggaan sekolah.') !!}
                </p>
            </div>
        </div>

        <!-- Sejarah Paskibra (Umum) Section Title is moved from here -->
    </div>

    <!-- Full width red background -->
    <div style="background-color: #d10000; padding: 4rem 0;">
        <div class="px-3 px-md-4 mx-auto" style="max-width: 1040px;">
            <!-- Sejarah Paskibra (Umum) Section Title moved inside red section -->
            <div class="mb-4">
                <h2 class="fw-bold d-flex align-items-center flex-wrap gap-2 mb-0" style="color: #ffffff;">
                    <span style="font-size: 1.5rem; letter-spacing: 1px;">SEJARAH</span>
                    <span class="d-inline-block px-3 py-1 shadow-sm" style="background-color: #ffffff; color: #d10000; font-size: 1.5rem; border-radius: 4px;">PASKIBRA</span>
                </h2>
            </div>

            <div style="font-size: 1.1rem; line-height: 1.9; text-align: justify; color: rgba(255, 255, 255, 0.95);">
                <p>
                    {!! nl2br($informasi['sejarah_umum_p1'] ?? '<strong>Paskibra (Pasukan Pengibar Bendera)</strong> adalah organisasi yang dibentuk di sekolah sebagai wadah untuk melatih kedisiplinan, tanggung jawab, dan rasa cinta tanah air bagi para siswa. Paskibra memiliki tugas utama untuk melaksanakan pengibaran dan penurunan Bendera Merah Putih pada setiap upacara bendera di sekolah.') !!}
                </p>
                <p>
                    {!! nl2br($informasi['sejarah_umum_p2'] ?? 'Asal mula berdirinya Paskibra tidak lepas dari sejarah Paskibraka (Pasukan Pengibar Bendera Pusaka) yang <strong>didirikan oleh Husein Mutahar pada tahun 1946 di Yogyakarta.</strong> Saat itu, beliau diberi kepercayaan oleh Presiden Soekarno untuk menyiapkan pengibaran Bendera Pusaka pada peringatan Hari Kemerdekaan Indonesia yang pertama. Semangat nasionalisme inilah yang kemudian menular ke sekolah-sekolah di seluruh Indonesia.') !!}
                </p>
                <p>
                    {!! nl2br($informasi['sejarah_umum_p3'] ?? 'Seiring berjalannya waktu, banyak sekolah yang mulai membentuk organisasi Paskibra sendiri. Di tingkat sekolah, Paskibra berfungsi untuk memperbaiki tata cara upacara bendera, membentuk karakter siswa yang disiplin dan bertanggung jawab, serta menumbuhkan semangat persatuan dan nasionalisme.') !!}
                </p>
                <p>
                    {!! nl2br($informasi['sejarah_umum_p4'] ?? 'Hingga kini, Paskibra telah menjadi salah satu organisasi yang sangat diminati oleh para siswa karena tidak hanya melatih fisik, tetapi juga membentuk mental dan jiwa kepemimpinan. Dengan semangat kebersamaan dan nasionalisme yang telah diwariskan sejak tahun 1946, Paskibra terus menjadi kebanggaan dan teladan bagi generasi muda di lingkungan sekolah.') !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection