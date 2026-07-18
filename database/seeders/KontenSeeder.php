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

        // 1. Seed Berita
        \App\Models\Berita::updateOrCreate(
            ['slug' => 'pendaftaran-anggota-baru-paskibra-2027-resmi-dibuka'],
            [
                'judul' => 'Pendaftaran Anggota Baru Paskibra 2027 Resmi Dibuka!',
                'isi' => '<p>Selamat datang calon pendaftar! Tahun ini kami kembali membuka pendaftaran untuk putra-putri terbaik SMA Negeri 1 Pontianak untuk bergabung dengan Paskibra Ganesha.</p><p>Persiapkan fisik, mental, dan dokumen persyaratan Anda. Pendaftaran dilakukan sepenuhnya melalui website ini.</p>',
                'kategori' => 'Informasi',
                'status' => 'diterbitkan',
            ]
        );

        \App\Models\Berita::updateOrCreate(
            ['slug' => 'kegiatan-latihan-gabungan-paskibra-se-kota-pontianak'],
            [
                'judul' => 'Kegiatan Latihan Gabungan Paskibra se-Kota Pontianak',
                'isi' => '<p>Pada akhir pekan lalu, Paskibra Ganesha sukses menyelenggarakan Latihan Gabungan yang diikuti oleh berbagai sekolah di Pontianak. Kegiatan ini bertujuan untuk menyamakan persepsi gerakan PBB dan mempererat tali silaturahmi antar satuan.</p>',
                'kategori' => 'Kegiatan',
                'status' => 'diterbitkan',
            ]
        );

        // 2. Seed Pengumuman
        \App\Models\Pengumuman::updateOrCreate(
            ['judul' => 'Persyaratan Berkas Seleksi Administrasi'],
            [
                'isi' => '<p>Mohon untuk seluruh calon anggota segera melengkapi berkas administrasi berupa Surat Izin Orang Tua dan Surat Keterangan Sehat sebelum batas waktu yang ditentukan. Berkas yang tidak lengkap akan otomatis dinyatakan tidak lolos seleksi awal.</p>',
                'jenis' => 'Penting',
                'user_id' => $adminId,
            ]
        );

        \App\Models\Pengumuman::updateOrCreate(
            ['judul' => 'Perubahan Jadwal Tes Samapta'],
            [
                'isi' => '<p>Diberitahukan bahwa Tes Kesamaptaan Jasmani yang semula dijadwalkan pada hari Sabtu pagi diundur menjadi Minggu sore dikarenakan penggunaan lapangan sekolah. Harap maklum.</p>',
                'jenis' => 'Jadwal',
                'user_id' => $adminId,
            ]
        );

        // 3. Seed Jadwal
        \App\Models\Jadwal::updateOrCreate(
            ['nama_kegiatan' => 'Pendaftaran Online'],
            [
                'tanggal_kegiatan' => now()->addDays(1)->toDateString(),
                'waktu' => '00:00',
                'tempat' => 'Website Paskibra Ganesha',
            ]
        );

        \App\Models\Jadwal::updateOrCreate(
            ['nama_kegiatan' => 'Seleksi Berkas & Administrasi'],
            [
                'tanggal_kegiatan' => now()->addDays(15)->toDateString(),
                'waktu' => '08:00',
                'tempat' => 'Ruang Sekretariat Paskibra',
            ]
        );
        
        \App\Models\Jadwal::updateOrCreate(
            ['nama_kegiatan' => 'Tes Fisik & Kesamaptaan'],
            [
                'tanggal_kegiatan' => now()->addDays(18)->toDateString(),
                'waktu' => '06:30',
                'tempat' => 'Lapangan Olahraga SMAN 1',
            ]
        );

        // 4. Seed Galeri
        \App\Models\Galeri::updateOrCreate(
            ['judul_foto' => 'Diklat Paskibra 2026'],
            [
                'tanggal_pelaksanaan' => now()->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now(),
            ]
        );
        
        \App\Models\Galeri::updateOrCreate(
            ['judul_foto' => 'Latihan Rutin PBB'],
            [
                'tanggal_pelaksanaan' => now()->subDays(5)->toDateString(),
                'file_foto' => 'images/fotoawal.png', 
                'tanggal_upload' => now(),
            ]
        );
    }
}
