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
            ['jenis_info' => 'visi', 'konten' => 'Mewujudkan anggota Paskibra SMA Negeri 1 Pontianak yang berakhlak mulia, disiplin, berjiwa nasionalisme tinggi, dan mampu menjadi teladan bagi siswa lainnya.', 'tanggal_update' => now()],
            ['jenis_info' => 'misi', 'konten' => "Menyelenggarakan latihan rutin PBB dan tata upacara bendera secara konsisten.\nMenanamkan nilai-nilai Pancasila, kedisiplinan, dan kepemimpinan.\nMengadakan kegiatan bakti sosial dan pengabdian masyarakat.", 'tanggal_update' => now()],

            // Pengurus Inti
            ['jenis_info' => 'org_kepsek_nama', 'konten' => 'Dwi Agustina, S.Hut., M.Pd.', 'tanggal_update' => now()],
            ['jenis_info' => 'org_kepsek_nip', 'konten' => '19750821 200501 2 004', 'tanggal_update' => now()],

            ['jenis_info' => 'org_pembina_nama', 'konten' => 'Eko Sulistyo, S.Pd.', 'tanggal_update' => now()],
            ['jenis_info' => 'org_pembina_nip', 'konten' => '19800512 201001 1 012', 'tanggal_update' => now()],

            ['jenis_info' => 'org_ketua_nama', 'konten' => 'Ahmad Fauzi', 'tanggal_update' => now()],
            ['jenis_info' => 'org_ketua_kelas', 'konten' => 'XI MIPA 2', 'tanggal_update' => now()],
        ];

        foreach ($defaultInformasi as $info) {
            Informasi::updateOrCreate(
                ['jenis_info' => $info['jenis_info']],
                $info
            );
        }
    }
}
