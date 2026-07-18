<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class StatusSeleksiController extends Controller
{
    private function getStages()
    {
        $kriterias = Kriteria::orderBy('id', 'asc')->get();
        $formulir = auth()->user()->formulirPendaftaran;
        
        $stages = [];
        
        foreach ($kriterias as $kriteria) {
            $hasil = null;
            if ($formulir && $formulir->hasilSeleksi) {
                $hasil = $formulir->hasilSeleksi->where('jenis_seleksi', $kriteria->nama)->first();
            }
            
            $stages[$kriteria->id] = [
                'title' => strtoupper($kriteria->nama),
                'date' => $hasil ? $hasil->created_at->format('d M Y') : '-',
                'status' => $hasil ? strtoupper($hasil->status_lulus) : null,
                'score' => $hasil ? floatval($hasil->nilai) : null,
                'keterangan' => $hasil ? $hasil->keterangan : null,
            ];
        }

        return $stages;
    }

    public function index()
    {
        $stages = $this->getStages();
        return view('calon.status_seleksi.index', compact('stages'));
    }

    public function show($id)
    {
        $stages = $this->getStages();
        
        if (!isset($stages[$id])) {
            abort(404);
        }

        $stage = $stages[$id];
        return view('calon.status_seleksi.show', compact('stage'));
    }
}
