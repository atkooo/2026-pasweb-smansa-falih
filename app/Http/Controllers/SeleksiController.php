<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirPendaftaran;
use App\Models\HasilSeleksi;

class SeleksiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data kriteria dari database
        $kriterias = \App\Models\Kriteria::orderBy('id', 'asc')->get();

        // Hanya ambil yang sudah disetujui
        $query = FormulirPendaftaran::with('user', 'hasilSeleksi')
                    ->where('status_pendaftaran', 'approved')
                    ->orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_panggilan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('nama_lengkap', 'like', "%{$search}%")
                         ->orWhere('nisn', 'like', "%{$search}%");
                  });
            });
        }

        $pesertas = $query->paginate(10);
        
        $pesertas->getCollection()->transform(function($p) use ($kriterias) {
            $p->nilai_kriteria = [];
            $nilai_akhir = 0;

            foreach ($kriterias as $k) {
                // Ambil nilai berdasarkan nama kriteria
                $hasil = $p->hasilSeleksi->where('jenis_seleksi', $k->nama)->first();
                $nilai = floatval($hasil->nilai ?? 0);
                
                // Simpan ke array untuk ditampilkan di view
                $p->nilai_kriteria[$k->id] = $nilai;

                // Hitung total dengan bobot
                $nilai_akhir += ($nilai * ($k->bobot / 100));
            }
            
            $p->nilai_akhir = $nilai_akhir;
            
            return $p;
        });

        return view('admin.seleksi.index', compact('pesertas', 'kriterias'));
    }

    public function show($id)
    {
        $pendaftaran = FormulirPendaftaran::with(['user', 'hasilSeleksi' => function($q) {
            $q->orderBy('created_at', 'desc');
        }])->findOrFail($id);
        
        $kriterias = \App\Models\Kriteria::orderBy('id', 'asc')->get();

        return view('admin.seleksi.show', compact('pendaftaran', 'kriterias'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'jenis_seleksi' => 'required|string|max:255',
            'nilai' => 'required|string|max:255',
            'status_lulus' => 'required|in:1,0',
            'keterangan' => 'nullable|string',
        ]);

        $pendaftaran = FormulirPendaftaran::findOrFail($id);

        HasilSeleksi::create([
            'formulir_pendaftaran_id' => $pendaftaran->id,
            'jenis_seleksi' => $request->jenis_seleksi,
            'nilai' => $request->nilai,
            'status_lulus' => $request->status_lulus,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Nilai seleksi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $hasil = HasilSeleksi::findOrFail($id);
        $hasil->delete();

        return redirect()->back()->with('success', 'Nilai seleksi berhasil dihapus.');
    }
}
