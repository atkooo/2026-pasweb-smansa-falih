<?php

namespace Database\Seeders;

use App\Models\Informasi;
use Illuminate\Database\Seeder;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultInformasi = [
            // Beranda
            ['jenis_info' => 'beranda_judul', 'konten' => 'PASKIBRA GANESHA', 'tanggal_update' => now()],
            ['jenis_info' => 'beranda_subjudul', 'konten' => 'SMA NEGERI 1 PONTIANAK', 'tanggal_update' => now()],
            ['jenis_info' => 'beranda_deskripsi', 'konten' => 'Website Paskibra Ganesha SMA Negeri 1 Pontianak hadir sebagai media informasi serta sistem informasi seleksi penerimaan anggota yang bertujuan untuk memudahkan calon anggota dalam memperoleh informasi, melakukan pendaftaran, dan mengikuti proses seleksi secara lebih efektif dan terstruktur.', 'tanggal_update' => now()],

            // Dokumen
            ['jenis_info' => 'doc1_judul', 'konten' => 'Surat Izin Orang Tua', 'tanggal_update' => now()],
            ['jenis_info' => 'doc2_judul', 'konten' => "Perpang TNI\nNo. 57 & 58", 'tanggal_update' => now()],
            ['jenis_info' => 'doc3_judul', 'konten' => "Buku Teks Utama\nPancasila Kelas X", 'tanggal_update' => now()],
            ['jenis_info' => 'doc4_judul', 'konten' => 'Tabel Penilaian Fisik', 'tanggal_update' => now()],

            // Sejarah
            ['jenis_info' => 'sejarah_singkat', 'konten' => 'Berawal dari keberhasilan Akhdan Wahyu, Dian Astiningsih, dan Nudi Wicaksono yang terpilih sebagai Paskibraka tingkat Provinsi dan Nasional pada tahun 1991-1992, muncul semangat untuk membentuk wadah pembinaan bagi generasi penerus di SMA Negeri 1 Pontianak. Berbekal pengalaman dan dedikasi mereka, <strong style="color: #000; font-weight: 600;">lahirlah Paskibra SMA Negeri 1 Pontianak</strong> sebagai organisasi yang berkomitmen membina karakter, kedisiplinan, jiwa kepemimpinan, serta semangat nasionalisme bagi para siswa.', 'tanggal_update' => now()],
            
            ['jenis_info' => 'sejarah_p1', 'konten' => '<strong>Berawal dari prestasi siswa SMA Negeri 1 Pontianak</strong> di tingkat Paskibraka, pada tahun 1991 Akhdan Wahyu terpilih sebagai Paskibraka Provinsi Kalimantan Barat. Setahun kemudian, tepatnya pada tahun 1992, Dian Astiningsih terpilih sebagai Paskibraka Nasional utusan Provinsi Kalimantan Barat, sementara Nudi Wicaksono terpilih sebagai Paskibraka Provinsi Kalimantan Barat. Berbekal pengalaman dan semangat pengabdian, ketiganya menjadi pelopor berdirinya Paskibra SMA Negeri 1 Pontianak dengan tujuan membagikan ilmu, pengalaman, serta nilai-nilai kedisiplinan kepada adik-adik mereka, sekaligus membentuk wadah pembinaan karakter, fisik, mental, dan jiwa kepemimpinan bagi siswa yang bercita-cita menjadi Paskibraka.', 'tanggal_update' => now()],
            ['jenis_info' => 'sejarah_p2', 'konten' => 'Gagasan tersebut akhirnya terwujud pada <strong>22 Februari 1993</strong>, saat Pasukan Pengibar Bendera SMA Negeri 1 Pontianak <strong>resmi didirikan</strong> dan ditandai dengan pengukuhan Angkatan I. Sejak berdiri, Paskibra SMA Negeri 1 Pontianak berada di bawah naungan OSIS dengan pembinaan dari Purna Paskibraka Indonesia (PPI), serta memiliki tujuan utama untuk meningkatkan kualitas pelaksanaan upacara bendera di sekolah, membentuk pribadi yang berkarakter, disiplin, bertanggung jawab, berjiwa nasionalisme, serta mampu mengharumkan nama sekolah melalui berbagai prestasi. Berkat kerja sama, kekompakan, dan dedikasi seluruh anggota yang didukung oleh para pembina, hingga kini Paskibra SMA Negeri 1 Pontianak terus menunjukkan eksistensinya sebagai organisasi yang solid, berprestasi, dan menjadi salah satu kebanggaan sekolah.', 'tanggal_update' => now()],

            ['jenis_info' => 'sejarah_umum_p1', 'konten' => '<strong>Paskibra (Pasukan Pengibar Bendera)</strong> adalah organisasi yang dibentuk di sekolah sebagai wadah untuk melatih kedisiplinan, tanggung jawab, dan rasa cinta tanah air bagi para siswa. Paskibra memiliki tugas utama untuk melaksanakan pengibaran dan penurunan Bendera Merah Putih pada setiap upacara bendera di sekolah.', 'tanggal_update' => now()],
            ['jenis_info' => 'sejarah_umum_p2', 'konten' => 'Asal mula berdirinya Paskibra tidak lepas dari sejarah Paskibraka (Pasukan Pengibar Bendera Pusaka) yang <strong>didirikan oleh Husein Mutahar pada tahun 1946 di Yogyakarta.</strong> Saat itu, beliau diberi kepercayaan oleh Presiden Soekarno untuk menyiapkan pengibaran Bendera Pusaka pada peringatan Hari Kemerdekaan Indonesia yang pertama. Semangat nasionalisme inilah yang kemudian menular ke sekolah-sekolah di seluruh Indonesia.', 'tanggal_update' => now()],
            ['jenis_info' => 'sejarah_umum_p3', 'konten' => 'Seiring berjalannya waktu, banyak sekolah yang mulai membentuk organisasi Paskibra sendiri. Di tingkat sekolah, Paskibra berfungsi untuk memperbaiki tata cara upacara bendera, membentuk karakter siswa yang disiplin dan bertanggung jawab, serta menumbuhkan semangat persatuan dan nasionalisme.', 'tanggal_update' => now()],
            ['jenis_info' => 'sejarah_umum_p4', 'konten' => 'Hingga kini, Paskibra telah menjadi salah satu organisasi yang sangat diminati oleh para siswa karena tidak hanya melatih fisik, tetapi juga membentuk mental dan jiwa kepemimpinan. Dengan semangat kebersamaan dan nasionalisme yang telah diwariskan sejak tahun 1946, Paskibra terus menjadi kebanggaan dan teladan bagi generasi muda di lingkungan sekolah.', 'tanggal_update' => now()],

            ['jenis_info' => 'visi', 'konten' => 'Mewujudkan anggota Paskibra SMA Negeri 1 Pontianak yang berakhlak mulia, disiplin, berjiwa nasionalisme tinggi, dan mampu menjadi teladan bagi siswa lainnya.', 'tanggal_update' => now()],
            ['jenis_info' => 'misi', 'konten' => "Menyelenggarakan latihan rutin PBB dan tata upacara bendera secara konsisten.\nMenanamkan nilai-nilai Pancasila, kedisiplinan, dan kepemimpinan.\nMengadakan kegiatan bakti sosial dan pengabdian masyarakat.", 'tanggal_update' => now()],

            // Pengurus Inti
            ['jenis_info' => 'org_kepsek_nama', 'konten' => 'Dwi Agustina, S.Hut., M.Pd.', 'tanggal_update' => now()],
            ['jenis_info' => 'org_kepsek_nip', 'konten' => '19750821 200501 2 004', 'tanggal_update' => now()],

            ['jenis_info' => 'org_pembina_nama', 'konten' => 'Eko Sulistyo, S.Pd.', 'tanggal_update' => now()],
            ['jenis_info' => 'org_pembina_nip', 'konten' => '19800512 201001 1 012', 'tanggal_update' => now()],

            ['jenis_info' => 'org_ketua_nama', 'konten' => 'Ahmad Fauzi', 'tanggal_update' => now()],
            ['jenis_info' => 'org_ketua_kelas', 'konten' => 'XI MIPA 2', 'tanggal_update' => now()],
            
            // Pengaturan Pendaftaran
            ['jenis_info' => 'pendaftaran_status', 'konten' => 'tutup', 'tanggal_update' => now()],
            ['jenis_info' => 'pendaftaran_tahun_aktif', 'konten' => date('Y'), 'tanggal_update' => now()],
        ];

        foreach ($defaultInformasi as $info) {
            Informasi::updateOrCreate(
                ['jenis_info' => $info['jenis_info']],
                $info
            );
        }
    }
}
