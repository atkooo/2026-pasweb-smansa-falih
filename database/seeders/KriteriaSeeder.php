<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriterias = [
            ['nama' => 'VERIFIKASI ADMINISTRASI', 'bobot' => 0],
            ['nama' => 'HASIL SELEKSI FISIK', 'bobot' => 25],
            ['nama' => 'BARIS BERBARIS', 'bobot' => 25],
            ['nama' => 'WAWANCARA', 'bobot' => 25],
            ['nama' => 'KESEHATAN', 'bobot' => 25],
            ['nama' => 'PENETAPAN HASIL SELEKSI', 'bobot' => 0],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::updateOrCreate(
                ['nama' => $kriteria['nama']],
                ['bobot' => $kriteria['bobot']]
            );
        }
    }
}
