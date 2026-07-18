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
        $filters = [
            'status' => $request->status,
            'search' => $request->search,
        ];
        
        $pendaftarans = $this->pendaftaranService->getPendaftarans($filters);
        
        return view('admin.pendaftaran.index', compact('pendaftarans'));
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
