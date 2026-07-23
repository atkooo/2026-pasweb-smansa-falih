<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Models\Informasi;
use App\Http\Requests\UpdateStatusPendaftaranRequest;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tahun aktif dari Informasi
        $informasi = Informasi::whereIn('jenis_info', ['pendaftaran_tahun_aktif'])->pluck('konten', 'jenis_info');
        $tahunAktif = $informasi['pendaftaran_tahun_aktif'] ?? date('Y');

        $filters = [
            'status' => $request->status,
            'search' => $request->search,
            'tahun_periode' => $request->has('tahun_periode') ? $request->tahun_periode : $tahunAktif,
        ];
        
        $query = FormulirPendaftaran::with('user')->orderBy('created_at', 'desc');

        if (!empty($filters['status'])) {
            $query->where('status_pendaftaran', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('nama_panggilan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('nama_lengkap', 'like', "%{$search}%")
                         ->orWhere('nisn', 'like', "%{$search}%");
                  });
            });
        }

        if (!empty($filters['tahun_periode'])) {
            $query->where('tahun_periode', $filters['tahun_periode']);
        }

        $pendaftarans = $query->paginate(10);

        $availableTahun = FormulirPendaftaran::select('tahun_periode')
            ->whereNotNull('tahun_periode')
            ->distinct()
            ->orderBy('tahun_periode', 'desc')
            ->pluck('tahun_periode');
        
        if (!$availableTahun->contains($tahunAktif)) {
            $availableTahun->push($tahunAktif);
            $availableTahun = $availableTahun->sortDesc();
        }
        
        return view('admin.pendaftaran.index', compact('pendaftarans', 'availableTahun', 'filters'));
    }

    public function show($id)
    {
        $pendaftaran = FormulirPendaftaran::with('user')->findOrFail($id);
        
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(UpdateStatusPendaftaranRequest $request, $id)
    {
        if (auth()->user()->role !== 'pengurus') {
            return redirect()->back()->with('error', 'Aksi tidak diizinkan. Hanya Pengurus yang berwenang melakukan verifikasi berkas pendaftaran.');
        }

        $pendaftaran = FormulirPendaftaran::with('user')->findOrFail($id);

        if (in_array($pendaftaran->status_pendaftaran, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', "Status pendaftaran {$pendaftaran->nama_panggilan} sudah " . ($pendaftaran->status_pendaftaran == 'approved' ? 'Disetujui' : 'Ditolak') . " dan tidak dapat diubah kembali.");
        }

        if ($pendaftaran->user && $pendaftaran->user->role === 'anggota' && $request->status_pendaftaran === 'rejected') {
            return redirect()->back()->with('error', "Status pendaftaran untuk Anggota Resmi tidak dapat Ditolak. Anda hanya dapat Menyetujui atau meminta Revisi Berkas.");
        }

        $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
        $pendaftaran->catatan_verifikasi = $request->catatan_verifikasi;
        $pendaftaran->save();

        $statusMsg = 'diperbarui';
        if ($request->status_pendaftaran == 'approved') $statusMsg = 'disetujui';
        if ($request->status_pendaftaran == 'rejected') $statusMsg = 'ditolak';
        if ($request->status_pendaftaran == 'revision') $statusMsg = 'diminta untuk update/revisi';
        if ($request->status_pendaftaran == 'pending') $statusMsg = 'dikembalikan ke pending';
        
        return redirect()->back()->with('success', "Status pendaftaran {$pendaftaran->nama_panggilan} berhasil {$statusMsg}.");
    }
}
