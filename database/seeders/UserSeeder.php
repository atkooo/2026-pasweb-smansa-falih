<?php

namespace Database\Seeders;

use App\Models\FormulirPendaftaran;
use App\Models\HasilSeleksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. User Demo (Calon Anggota Utama)
        $user1 = User::updateOrCreate(
            ['nisn' => '1234567890'],
            [
                'nama_lengkap' => 'Falih Agung',
                'password' => Hash::make('password123'),
                'role' => 'calon_anggota',
            ]
        );

        // 2. User Demo (Pengurus)
        User::updateOrCreate(
            ['nisn' => '0987654321'],
            [
                'nama_lengkap' => 'Siti Aminah',
                'password' => Hash::make('password123'),
                'role' => 'pengurus',
            ]
        );

        // 3. User Demo (Anggota Resmi)
        $userAnggota = User::updateOrCreate(
            ['nisn' => '1122334455'],
            [
                'nama_lengkap' => 'Budi Santoso',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
            ]
        );

        // Formulir & Hasil Seleksi untuk Anggota Resmi
        $fpAnggota = FormulirPendaftaran::updateOrCreate(
            ['user_id' => $userAnggota->id],
            [
                'nama_panggilan' => 'Budi',
                'tempat_lahir' => 'Pontianak',
                'tanggal_lahir' => '2008-05-14',
                'jenis_kelamin' => 'Laki-Laki',
                'agama' => 'Islam',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Ahmad Yani No. 45, Pontianak',
                'asal_sekolah' => 'SMP Negeri 1 Pontianak',
                'tinggi_badan' => 175,
                'berat_badan' => 65,
                'riwayat_penyakit' => 'Tidak Ada',
                'cita_cita' => 'Taruna Akpol',
                'ekskul_lain' => 'Pramuka',
                'motivasi' => 'Ingin mengabdi kepada nusa dan bangsa melalui Paskibra serta membentuk karakter disiplin tinggi.',
                'opsi_pilihan' => 'YA',
                'motto_hidup' => 'Disiplin adalah Kunci Kesuksesan Utama',
                'upload_surat_izin' => 'surat_izin.pdf',
                'upload_skd' => 'skd.pdf',
                'upload_kk' => 'kk.pdf',
                'tahun_periode' => date('Y'),
                'status_pendaftaran' => 'approved',
                'status_kelulusan' => 'LOLOS',
            ]
        );

        // Add scores for Anggota Resmi
        HasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $fpAnggota->id, 'jenis_seleksi' => 'BARIS BERBARIS'],
            ['nilai' => 88.0, 'status_lulus' => 'lulus', 'keterangan' => 'Gerakan sangat tegas & presisi']
        );
        HasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $fpAnggota->id, 'jenis_seleksi' => 'HASIL SELEKSI FISIK'],
            ['nilai' => 85.0, 'status_lulus' => 'lulus', 'keterangan' => 'Fisik prima']
        );

        // 4. Tambahan Calon Anggota 2 (Lolos)
        $user2 = User::updateOrCreate(
            ['nisn' => '1234567891'],
            [
                'nama_lengkap' => 'Anisa Rahmawati',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
            ]
        );
        $fp2 = FormulirPendaftaran::updateOrCreate(
            ['user_id' => $user2->id],
            [
                'nama_panggilan' => 'Anisa',
                'tempat_lahir' => 'Pontianak',
                'tanggal_lahir' => '2008-08-20',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'no_hp' => '082155443322',
                'alamat' => 'Jl. Gajah Mada No. 12',
                'asal_sekolah' => 'SMP Negeri 3 Pontianak',
                'tinggi_badan' => 165,
                'berat_badan' => 52,
                'riwayat_penyakit' => 'Tidak Ada',
                'cita_cita' => 'Kowad',
                'ekskul_lain' => 'PMR',
                'motivasi' => 'Ingin mengharumkan nama sekolah dan menjadi Paskibraka.',
                'opsi_pilihan' => 'YA',
                'motto_hidup' => 'Berani Berbuat, Berani Bertanggung Jawab',
                'upload_surat_izin' => 'surat_izin.pdf',
                'upload_skd' => 'skd.pdf',
                'upload_kk' => 'kk.pdf',
                'tahun_periode' => date('Y'),
                'status_pendaftaran' => 'approved',
                'status_kelulusan' => 'LOLOS',
            ]
        );
        HasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $fp2->id, 'jenis_seleksi' => 'BARIS BERBARIS'],
            ['nilai' => 82.0, 'status_lulus' => 'lulus']
        );
        HasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $fp2->id, 'jenis_seleksi' => 'HASIL SELEKSI FISIK'],
            ['nilai' => 80.0, 'status_lulus' => 'lulus']
        );

        // 5. Tambahan Calon Anggota 3 (Tidak Lolos)
        $user3 = User::updateOrCreate(
            ['nisn' => '1234567892'],
            [
                'nama_lengkap' => 'Rian Hidayat',
                'password' => Hash::make('password123'),
                'role' => 'calon_anggota',
            ]
        );
        $fp3 = FormulirPendaftaran::updateOrCreate(
            ['user_id' => $user3->id],
            [
                'nama_panggilan' => 'Rian',
                'tempat_lahir' => 'Mempawah',
                'tanggal_lahir' => '2008-03-10',
                'jenis_kelamin' => 'Laki-Laki',
                'agama' => 'Islam',
                'no_hp' => '089611223344',
                'alamat' => 'Jl. Veteran No. 88',
                'asal_sekolah' => 'SMP Negeri 2 Pontianak',
                'tinggi_badan' => 162,
                'berat_badan' => 50,
                'riwayat_penyakit' => 'Asma Ringan',
                'cita_cita' => 'Pengusaha',
                'ekskul_lain' => 'Futsal',
                'motivasi' => 'Ingin belajar kedisiplinan dan menambah teman.',
                'opsi_pilihan' => 'TIDAK',
                'motto_hidup' => 'Pantang Menyerah Sebelum Mencoba',
                'upload_surat_izin' => 'surat_izin.pdf',
                'upload_skd' => 'skd.pdf',
                'upload_kk' => 'kk.pdf',
                'tahun_periode' => date('Y'),
                'status_kelulusan' => 'TIDAK LOLOS',
            ]
        );
        HasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $fp3->id, 'jenis_seleksi' => 'BARIS BERBARIS'],
            ['nilai' => 60.0, 'status_lulus' => 'tidak_lulus']
        );
        HasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $fp3->id, 'jenis_seleksi' => 'HASIL SELEKSI FISIK'],
            ['nilai' => 55.0, 'status_lulus' => 'tidak_lulus']
        );
    }
}
