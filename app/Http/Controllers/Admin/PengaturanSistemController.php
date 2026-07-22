<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use App\Models\Informasi;
use Illuminate\Http\Request;

class PengaturanSistemController extends Controller
{
    public function index()
    {
        // Ambil semua setting pendaftaran dari tabel informasi
        $settings = Informasi::whereIn('jenis_info', [
            'pendaftaran_status',
            'pendaftaran_tahun_aktif',
        ])->pluck('konten', 'jenis_info');

        $statusPendaftaran = $settings['pendaftaran_status'] ?? 'tutup';
        $tahunAktif        = $settings['pendaftaran_tahun_aktif'] ?? date('Y');

        // Statistik per tahun untuk tabel arsip
        $arsipPerTahun = FormulirPendaftaran::selectRaw("
                tahun_periode,
                COUNT(*) as total_pendaftar,
                SUM(CASE WHEN status_kelulusan = 'lulus' THEN 1 ELSE 0 END) as total_lulus,
                SUM(CASE WHEN status_kelulusan = 'tidak_lulus' THEN 1 ELSE 0 END) as total_tidak_lulus,
                SUM(CASE WHEN status_pendaftaran = 'approved' THEN 1 ELSE 0 END) as total_approved
            ")
            ->whereNotNull('tahun_periode')
            ->groupBy('tahun_periode')
            ->orderBy('tahun_periode', 'desc')
            ->get();

        // Tambah tahun aktif ke arsip jika belum ada (bisa belum ada pendaftar)
        $tahunDiArsip = $arsipPerTahun->pluck('tahun_periode')->toArray();
        if (!in_array($tahunAktif, $tahunDiArsip)) {
            $arsipPerTahun->prepend((object) [
                'tahun_periode'     => $tahunAktif,
                'total_pendaftar'   => 0,
                'total_lulus'       => 0,
                'total_tidak_lulus' => 0,
                'total_approved'    => 0,
            ]);
        }

        return view('admin.pengaturan-sistem.index', compact(
            'statusPendaftaran',
            'tahunAktif',
            'arsipPerTahun'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tahun_aktif' => 'required|digits:4|integer|min:2000|max:2100',
        ]);

        Informasi::updateOrCreate(
            ['jenis_info' => 'pendaftaran_tahun_aktif'],
            ['konten' => $request->tahun_aktif, 'tanggal_update' => now()]
        );

        return redirect()->route('admin.pengaturan-sistem.index')
            ->with('success', 'Tahun periode aktif berhasil diperbarui menjadi ' . $request->tahun_aktif . '.');
    }

    public function toggleStatus(Request $request)
    {
        $current = Informasi::where('jenis_info', 'pendaftaran_status')->first();
        $newStatus = ($current && $current->konten === 'buka') ? 'tutup' : 'buka';

        Informasi::updateOrCreate(
            ['jenis_info' => 'pendaftaran_status'],
            ['konten' => $newStatus, 'tanggal_update' => now()]
        );

        $label = $newStatus === 'buka' ? 'dibuka' : 'ditutup';
        return redirect()->route('admin.pengaturan-sistem.index')
            ->with('success', "Status pendaftaran berhasil {$label}.");
    }
}
