<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirPendaftaran;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = FormulirPendaftaran::with('user')->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status_pendaftaran', $request->status);
        }

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

        $pendaftarans = $query->paginate(10);
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        $pendaftaran = FormulirPendaftaran::with('user')->findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function verifikasi(Request $request)
    {
        $query = FormulirPendaftaran::with('user')->orderBy('created_at', 'desc');

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

        $pendaftarans = $query->paginate(10);
        return view('admin.pendaftaran.verifikasi', compact('pendaftarans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:pending,approved,rejected',
        ]);

        $pendaftaran = FormulirPendaftaran::findOrFail($id);
        $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
        $pendaftaran->save();

        $statusMsg = $request->status_pendaftaran == 'approved' ? 'disetujui' : ($request->status_pendaftaran == 'rejected' ? 'ditolak' : 'dikembalikan ke pending');
        return redirect()->back()->with('success', "Status pendaftaran {$pendaftaran->nama_panggilan} berhasil {$statusMsg}.");
    }
}
