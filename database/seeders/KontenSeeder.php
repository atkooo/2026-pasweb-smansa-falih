<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : 1;

        // 1. Seed Berita (Banyak Berita & Beragam Kategori)
        $beritas = [
            [
                'slug' => 'pendaftaran-anggota-baru-paskibra-2027-resmi-dibuka',
                'judul' => 'Pendaftaran Anggota Baru Paskibra 2027 Resmi Dibuka!',
                'isi' => '<p>Selamat datang calon pendaftar! Tahun ini kami kembali membuka pendaftaran untuk putra-putri terbaik SMA Negeri 1 Pontianak untuk bergabung dengan Paskibra Ganesha.</p><p>Persiapkan fisik, mental, dan dokumen persyaratan Anda. Pendaftaran dilakukan sepenuhnya melalui website ini.</p>',
                'kategori' => 'Informasi',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(1),
            ],
            [
                'slug' => 'kegiatan-latihan-gabungan-paskibra-se-kota-pontianak',
                'judul' => 'Kegiatan Latihan Gabungan Paskibra se-Kota Pontianak',
                'isi' => '<p>Pada akhir pekan lalu, Paskibra Ganesha sukses menyelenggarakan Latihan Gabungan yang diikuti oleh berbagai sekolah di Pontianak. Kegiatan ini bertujuan untuk menyamakan persepsi gerakan PBB dan mempererat tali silaturahmi antar satuan.</p>',
                'kategori' => 'Kegiatan',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(3),
            ],
            [
                'slug' => 'prestasi-membanggakan-paskibra-ganesha-raih-juara-1-lbb',
                'judul' => 'Prestasi Membanggakan! Paskibra Ganesha Raih Juara 1 LBB Kota Pontianak',
                'isi' => '<p>Tim Paskibra SMA Negeri 1 Pontianak berhasil meraih Juara Umum dan Juara 1 Lomba Baris Berbaris (LBB) tingkat SMA/K se-Kota Pontianak. Kerja keras dan latihan disiplin selama 2 bulan membuahkan hasil luar biasa.</p>',
                'kategori' => 'Prestasi',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(7),
            ],
            [
                'slug' => 'pengukuhan-anggota-baru-paskibra-ganesha-periode-2026',
                'judul' => 'Pengukuhan Anggota Baru Paskibra Ganesha Periode 2026',
                'isi' => '<p>Sebanyak 30 siswa-siswi terbaik resmi dikukuhkan sebagai anggota aktif Paskibra Ganesha SMAN 1 Pontianak. Acara pengukuhan dipimpin langsung oleh Kepala Sekolah dan disaksikan oleh pembina serta para alumni.</p>',
                'kategori' => 'Kegiatan',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(12),
            ],
            [
                'slug' => 'bakti-sosial-dan-peringatan-hari-pahlawan-paskibra-ganesha',
                'judul' => 'Bakti Sosial & Peringatan Hari Pahlawan Bersama Alumni',
                'isi' => '<p>Dalam rangka memperingati Hari Pahlawan, keluarga besar Paskibra Ganesha mengadakan aksi sosial pembagian sembako dan donor darah bersama Purna Paskibraka Indonesia (PPI).</p>',
                'kategori' => 'Pengabdian',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(20),
            ],
            [
                'slug' => 'workshop-kepemimpinan-dan-kedisiplinan-generasi-muda',
                'judul' => 'Workshop Kepemimpinan & Kedisiplinan Generasi Muda',
                'isi' => '<p>Paskibra Ganesha menyelenggarakan workshop internal bertema "Membangun Karakter Pemimpin Berjiwa Pancasila" dengan menghadirkan narasumber dari Kodim dan Purna Paskibraka Indonesia.</p>',
                'kategori' => 'Informasi',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(25),
            ],
            [
                'slug' => 'persiapan-gladi-bersih-upacara-kemerdekaan-ri',
                'judul' => 'Persiapan Gladi Bersih Upacara Kemerdekaan RI',
                'isi' => '<p>Pasukan pengibar bendera utama memasuki tahap gladi bersih akhir jelang upacara peringatan Kemerdekaan Republik Indonesia di Lapangan Utama SMAN 1 Pontianak.</p>',
                'kategori' => 'Kegiatan',
                'status' => 'diterbitkan',
                'created_at' => now()->subDays(30),
            ],
            [
                'slug' => 'draft-rencana-kegiatan-orientasi-anggota-muda',
                'judul' => '[Draft] Rencana Kegiatan Orientasi Anggota Muda 2027',
                'isi' => '<p>Rancangan konsep dan susunan acara orientasi bagi calon anggota muda angkatan terbaru Paskibra Ganesha.</p>',
                'kategori' => 'Informasi',
                'status' => 'draf',
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($beritas as $b) {
            \App\Models\Berita::updateOrCreate(['slug' => $b['slug']], $b);
        }

        // 2. Seed Pengumuman (Pengumuman Resmi)
        $pengumumans = [
            [
                'judul' => 'Persyaratan Berkas Seleksi Administrasi 2026/2027',
                'isi' => '<p>Mohon untuk seluruh calon anggota segera melengkapi berkas administrasi berupa Surat Izin Orang Tua, Kartu Keluarga, dan Surat Keterangan Sehat sebelum batas waktu yang ditentukan. Berkas yang tidak lengkap akan otomatis dinyatakan tidak lolos seleksi awal.</p>',
                'jenis' => 'Penting',
                'user_id' => $adminId,
            ],
            [
                'judul' => 'Perubahan Jadwal Tes Kesamaptaan Jasmani',
                'isi' => '<p>Diberitahukan bahwa Tes Kesamaptaan Jasmani yang semula dijadwalkan pada hari Sabtu pagi diundur menjadi Minggu sore dikarenakan penggunaan lapangan sekolah. Harap maklum dan datang tepat waktu membawa pakaian olahraga resmi.</p>',
                'jenis' => 'Jadwal',
                'user_id' => $adminId,
            ],
            [
                'judul' => 'Pembagian Kelompok Latihan PBB Rutin Semester Ganjil',
                'isi' => '<p>Daftar pembagian peleton dan kelompok latihan PBB rutin semester ini dapat dilihat pada papan pengumuman sekretariat atau mengunduh dokumen lampiran di bawah ini.</p>',
                'jenis' => 'Informasi',
                'user_id' => $adminId,
            ],
            [
                'judul' => 'Atribut Resmi & Perlengkapan Seragam Latihan',
                'isi' => '<p>Setiap anggota wajib mengenakan seragam PDL/PDB resmi Paskibra Ganesha, sepatu pdh/pdl hitam, serta dasi dan lambang angkatan pada saat latihan rutin maupun tugas upacara.</p>',
                'jenis' => 'Penting',
                'user_id' => $adminId,
            ],
            [
                'judul' => 'Hasil Verifikasi Kelulusan Akhir Penerimaan Anggota',
                'isi' => '<p>Pengumuman penetapan hasil seleksi penerimaan anggota baru Paskibra Ganesha telah dapat diakses melalui menu Status Kelulusan pada akun masing-masing peserta.</p>',
                'jenis' => 'Hasil Seleksi',
                'user_id' => $adminId,
            ],
        ];

        foreach ($pengumumans as $p) {
            \App\Models\Pengumuman::updateOrCreate(['judul' => $p['judul']], $p);
        }

        // 3. Seed Jadwal Kegiatan
        $jadwals = [
            [
                'nama_kegiatan' => 'Pendaftaran Online Anggota Baru',
                'tanggal_kegiatan' => now()->addDays(2)->toDateString(),
                'waktu' => '08:00',
                'tempat' => 'Website Portal Paskibra Ganesha',
            ],
            [
                'nama_kegiatan' => 'Seleksi Administrasi & Verifikasi Berkas',
                'tanggal_kegiatan' => now()->addDays(7)->toDateString(),
                'waktu' => '08:00',
                'tempat' => 'Ruang Sekretariat Paskibra SMAN 1',
            ],
            [
                'nama_kegiatan' => 'Tes Kesamaptaan & Ketangkasan Fisik',
                'tanggal_kegiatan' => now()->addDays(12)->toDateString(),
                'waktu' => '06:30',
                'tempat' => 'Lapangan Olahraga Utama SMAN 1',
            ],
            [
                'nama_kegiatan' => 'Seleksi PBB Dasar & Wawancara Keorganisasian',
                'tanggal_kegiatan' => now()->addDays(15)->toDateString(),
                'waktu' => '07:30',
                'tempat' => 'Aula Utama SMA Negeri 1 Pontianak',
            ],
            [
                'nama_kegiatan' => 'Pengumuman Hasil Penetapan Anggota Baru',
                'tanggal_kegiatan' => now()->addDays(20)->toDateString(),
                'waktu' => '10:00',
                'tempat' => 'Online Portal & Papan Pengumuman',
            ],
            [
                'nama_kegiatan' => 'Latihan Rutin PBB & Formasi Pengibaran',
                'tanggal_kegiatan' => now()->addDays(25)->toDateString(),
                'waktu' => '15:30',
                'tempat' => 'Lapangan Utama SMAN 1',
            ],
            [
                'nama_kegiatan' => 'Gladi Bersih Upacara Bendera Mingguan',
                'tanggal_kegiatan' => now()->addDays(30)->toDateString(),
                'waktu' => '15:00',
                'tempat' => 'Lapangan Upacara SMAN 1 Pontianak',
            ],
            [
                'nama_kegiatan' => 'Diklat Kepemimpinan & Pengukuhan Angkatan',
                'tanggal_kegiatan' => now()->addDays(45)->toDateString(),
                'waktu' => '07:00',
                'tempat' => 'Gedung Serbaguna & Bumi Perkemahan',
            ],
        ];

        foreach ($jadwals as $j) {
            \App\Models\Jadwal::updateOrCreate(['nama_kegiatan' => $j['nama_kegiatan']], $j);
        }

        // 4. Seed Galeri Foto
        $galeris = [
            [
                'judul_foto' => 'Diklat Kepemimpinan Paskibra 2026',
                'tanggal_pelaksanaan' => now()->subDays(10)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now()->subDays(10),
            ],
            [
                'judul_foto' => 'Latihan Rutin Peraturan Baris Berbaris (PBB)',
                'tanggal_pelaksanaan' => now()->subDays(15)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now()->subDays(15),
            ],
            [
                'judul_foto' => 'Dokumentasi Juara 1 Lomba Baris Berbaris',
                'tanggal_pelaksanaan' => now()->subDays(20)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now()->subDays(20),
            ],
            [
                'judul_foto' => 'Pemusatan Latihan & Outbound Kebersamaan',
                'tanggal_pelaksanaan' => now()->subDays(25)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now()->subDays(25),
            ],
            [
                'judul_foto' => 'Upacara Pengukuhan Anggota Paskibra Ganesha',
                'tanggal_pelaksanaan' => now()->subDays(30)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now()->subDays(30),
            ],
            [
                'judul_foto' => 'Bakti Sosial & Donor Darah Keluarga Besar Paskibra',
                'tanggal_pelaksanaan' => now()->subDays(35)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now()->subDays(35),
            ],
        ];

        foreach ($galeris as $g) {
            \App\Models\Galeri::updateOrCreate(['judul_foto' => $g['judul_foto']], $g);
        }
    }
}
