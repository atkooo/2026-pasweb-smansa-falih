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
            ['nama' => 'HASIL SELEKSI FISIK', 'bobot' => 25, 'nilai_minimal_lulus' => 75],
            ['nama' => 'BARIS BERBARIS', 'bobot' => 25, 'nilai_minimal_lulus' => 75],
            ['nama' => 'WAWANCARA', 'bobot' => 25, 'nilai_minimal_lulus' => 75],
            ['nama' => 'KESEHATAN', 'bobot' => 25, 'nilai_minimal_lulus' => 75],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::updateOrCreate(
                ['nama' => $kriteria['nama']],
                ['bobot' => $kriteria['bobot'], 'nilai_minimal_lulus' => $kriteria['nilai_minimal_lulus']]
            );
        }
    }
}
