<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StatusSeleksiController extends Controller
{
    private function getMockStages()
    {
        return [
            1 => ['title' => 'VERIFIKASI ADMINISTRASI', 'date' => '-', 'status' => null, 'score' => null],
            2 => ['title' => 'HASIL SELEKSI FISIK', 'date' => '-', 'status' => null, 'score' => null],
            3 => ['title' => 'BARIS BERBARIS', 'date' => '-', 'status' => null, 'score' => null],
            4 => ['title' => 'WAWANCARA', 'date' => '-', 'status' => null, 'score' => null],
            5 => ['title' => 'KESEHATAN', 'date' => '-', 'status' => null, 'score' => null],
            6 => ['title' => 'PENETAPAN HASIL SELEKSI', 'date' => '-', 'status' => null, 'score' => null],
        ];
    }

    public function index()
    {
        $stages = $this->getMockStages();
        return view('calon.status_seleksi.index', compact('stages'));
    }

    public function show($id)
    {
        $stages = $this->getMockStages();
        
        if (!isset($stages[$id])) {
            abort(404);
        }

        $stage = $stages[$id];
        return view('calon.status_seleksi.show', compact('stage'));
    }
}
