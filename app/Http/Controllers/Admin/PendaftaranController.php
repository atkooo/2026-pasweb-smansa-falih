<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\PendaftaranService;
use App\Http\Requests\UpdateStatusPendaftaranRequest;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    protected $pendaftaranService;

    public function __construct(PendaftaranService $pendaftaranService)
    {
        $this->pendaftaranService = $pendaftaranService;
    }

    public function index(Request $request)
    {
        // Get active year from Informasi
        $informasi = \App\Models\Informasi::whereIn('jenis_info', ['pendaftaran_tahun_aktif'])->pluck('konten', 'jenis_info');
        $tahunAktif = $informasi['pendaftaran_tahun_aktif'] ?? date('Y');

        $filters = [
            'status' => $request->status,
            'search' => $request->search,
            'tahun_periode' => $request->has('tahun_periode') ? $request->tahun_periode : $tahunAktif,
        ];
        
        $pendaftarans = $this->pendaftaranService->getPendaftarans($filters);
        $availableTahun = $this->pendaftaranService->getAvailableTahun();
        
        // Add current active year if it's not in the list yet
        if (!$availableTahun->contains($tahunAktif)) {
            $availableTahun->push($tahunAktif);
            $availableTahun = $availableTahun->sortDesc();
        }
        
        return view('admin.pendaftaran.index', compact('pendaftarans', 'availableTahun', 'filters'));
    }

    public function show($id)
    {
        $pendaftaran = $this->pendaftaranService->getPendaftaranDetail($id);
        
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }



    public function updateStatus(UpdateStatusPendaftaranRequest $request, $id)
    {
        $pendaftaran = $this->pendaftaranService->updateStatus($id, $request->status_pendaftaran, $request->catatan_verifikasi);

        $statusMsg = 'diperbarui';
        if ($request->status_pendaftaran == 'approved') $statusMsg = 'disetujui';
        if ($request->status_pendaftaran == 'rejected') $statusMsg = 'ditolak';
        if ($request->status_pendaftaran == 'revision') $statusMsg = 'diminta untuk update/revisi';
        if ($request->status_pendaftaran == 'pending') $statusMsg = 'dikembalikan ke pending';
        
        return redirect()->back()->with('success', "Status pendaftaran {$pendaftaran->nama_panggilan} berhasil {$statusMsg}.");
    }
}
