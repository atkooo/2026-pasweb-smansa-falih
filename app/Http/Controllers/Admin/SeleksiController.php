<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\SeleksiService;
use App\Http\Requests\StoreSeleksiRequest;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    protected $seleksiService;

    public function __construct(SeleksiService $seleksiService)
    {
        $this->seleksiService = $seleksiService;
    }

    public function index(Request $request)
    {
        $informasi = \App\Models\Informasi::whereIn('jenis_info', ['pendaftaran_tahun_aktif'])->pluck('konten', 'jenis_info');
        $tahunAktif = $informasi['pendaftaran_tahun_aktif'] ?? date('Y');

        $filters = [
            'search' => $request->search,
            'tahun_periode' => $request->has('tahun_periode') ? $request->tahun_periode : $tahunAktif,
        ];

        $kriterias = $this->seleksiService->getAllKriteria();
        $pesertas = $this->seleksiService->getPesertaWithScores($filters);
        
        $availableTahun = $this->seleksiService->getAvailableTahun();
        if (!$availableTahun->contains($tahunAktif)) {
            $availableTahun->push($tahunAktif);
            $availableTahun = $availableTahun->sortDesc();
        }

        return view('admin.seleksi.index', compact('pesertas', 'kriterias', 'availableTahun', 'filters'));
    }

    public function show($id)
    {
        $pendaftaran = $this->seleksiService->getPendaftaranDetail($id);
        $kriterias = $this->seleksiService->getAllKriteria();

        return view('admin.seleksi.show', compact('pendaftaran', 'kriterias'));
    }

    public function store(StoreSeleksiRequest $request, $id)
    {
        if (auth()->user()->role !== 'pengurus') {
            return redirect()->back()->with('error', 'Aksi tidak diizinkan. Hanya Pengurus yang berwenang menginput nilai seleksi.');
        }

        $this->seleksiService->storeScore($id, $request->validated());

        return redirect()->back()->with('success', 'Nilai seleksi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'pengurus') {
            return redirect()->back()->with('error', 'Aksi tidak diizinkan. Hanya Pengurus yang berwenang menghapus nilai seleksi.');
        }

        $this->seleksiService->deleteScore($id);

        return redirect()->back()->with('success', 'Nilai seleksi berhasil dihapus.');
    }

    public function setKelulusan(Request $request, $id)
    {
        if (auth()->user()->role !== 'pengurus') {
            return redirect()->back()->with('error', 'Aksi tidak diizinkan. Hanya Pengurus yang berwenang menetapkan kelulusan akhir.');
        }

        $request->validate([
            'status_kelulusan' => 'required|in:LOLOS,TIDAK LOLOS,Menunggu'
        ]);

        $status = $request->status_kelulusan === 'Menunggu' ? null : $request->status_kelulusan;
        
        $this->seleksiService->setKelulusan($id, $status);

        return redirect()->back()->with('success', 'Status kelulusan akhir berhasil diperbarui.');
    }
}
