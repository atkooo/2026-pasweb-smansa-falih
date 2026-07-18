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

        // 1. Verifikasi Administrasi (Tahap Awal)
        $adminStatus = null;
        if ($formulir) {
            if ($formulir->status_pendaftaran === 'approved') $adminStatus = 'SELESAI';
            elseif ($formulir->status_pendaftaran === 'rejected') $adminStatus = 'DITOLAK';
            elseif ($formulir->status_pendaftaran === 'revision') $adminStatus = 'REVISI';
        }
        $stages['admin'] = [
            'title' => 'VERIFIKASI ADMINISTRASI',
            'date' => $formulir && $formulir->updated_at ? $formulir->updated_at->format('d M Y') : '-',
            'status' => $adminStatus,
            'score' => null,
            'keterangan' => $formulir && $formulir->catatan_verifikasi ? $formulir->catatan_verifikasi : 'Pengecekan kelengkapan berkas.',
            'is_scoring' => false,
        ];
        
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
                'is_scoring' => true,
            ];
        }

        // Akhir: Penetapan Hasil Seleksi
        $stages['final'] = [
            'title' => 'PENETAPAN HASIL SELEKSI',
            'date' => $formulir && $formulir->status_kelulusan ? $formulir->updated_at->format('d M Y') : '-',
            'status' => $formulir ? $formulir->status_kelulusan : null,
            'score' => null,
            'keterangan' => 'Pengumuman akhir hasil seleksi.',
            'is_scoring' => false,
        ];

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
