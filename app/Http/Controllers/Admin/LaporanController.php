<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Berita;
use App\Models\Jadwal;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori', 'pengguna');
        $search = $request->query('search');
        $data = collect();

        if ($kategori === 'pengguna') {
            $query = User::query();
            if ($search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            }
            if ($request->filled('role')) {
                $query->where('role', $request->role);
            }
            $data = $query->paginate(10);
        } elseif ($kategori === 'pendaftar') {
            $query = \App\Models\FormulirPendaftaran::with('user');
            if ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('asal_sekolah', 'like', "%{$search}%");
            }
            if ($request->filled('status_pendaftaran')) {
                $query->where('status_pendaftaran', $request->status_pendaftaran);
            }
            if ($request->filled('status_kelulusan')) {
                $query->where('status_kelulusan', $request->status_kelulusan);
            }
            $data = $query->paginate(10);
        } elseif ($kategori === 'berita') {
            $query = Berita::query();
            if ($search) {
                $query->where('judul', 'like', "%{$search}%");
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            $data = $query->paginate(10);
        } elseif ($kategori === 'jadwal') {
            $query = Jadwal::query();
            if ($search) {
                $query->where('nama_kegiatan', 'like', "%{$search}%");
            }
            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal_kegiatan', $request->bulan);
            }
            $data = $query->paginate(10);
        } else {
            $kategori = 'pengguna';
            $data = User::paginate(10);
        }

        return view('admin.laporan.index', compact('data', 'kategori'));
    }

    public function export(Request $request)
    {
        $kategori = $request->query('kategori', 'pengguna');
        $search = $request->query('search');
        $filename = 'laporan_' . $kategori . '_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [];
        $rows = [];

        if ($kategori === 'pengguna') {
            $columns = ['No', 'Nama Lengkap', 'Email', 'Role', 'Tanggal Daftar'];
            $query = User::query();
            if ($search) $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            if ($request->filled('role')) $query->where('role', $request->role);
            $users = $query->get();
            foreach ($users as $index => $user) {
                $rows[] = [
                    $index + 1,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '-'
                ];
            }
        } elseif ($kategori === 'pendaftar') {
            $columns = ['No', 'Nama Peserta', 'Asal Sekolah', 'Jenis Kelamin', 'Status Pendaftaran', 'Status Kelulusan'];
            $query = \App\Models\FormulirPendaftaran::with('user');
            if ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('asal_sekolah', 'like', "%{$search}%");
            }
            if ($request->filled('status_pendaftaran')) $query->where('status_pendaftaran', $request->status_pendaftaran);
            if ($request->filled('status_kelulusan')) $query->where('status_kelulusan', $request->status_kelulusan);
            $pendaftars = $query->get();
            foreach ($pendaftars as $index => $pendaftar) {
                $rows[] = [
                    $index + 1,
                    $pendaftar->user->name ?? '-',
                    $pendaftar->asal_sekolah,
                    $pendaftar->jenis_kelamin,
                    $pendaftar->status_pendaftaran,
                    $pendaftar->status_kelulusan ?? 'Belum Ditentukan'
                ];
            }
        } elseif ($kategori === 'berita') {
            $columns = ['No', 'Judul', 'Kategori', 'Status', 'Tanggal Posting'];
            $query = Berita::query();
            if ($search) $query->where('judul', 'like', "%{$search}%");
            if ($request->filled('status')) $query->where('status', $request->status);
            $beritas = $query->get();
            foreach ($beritas as $index => $berita) {
                $rows[] = [
                    $index + 1,
                    $berita->judul,
                    $berita->kategori ?? 'Umum',
                    $berita->status,
                    $berita->created_at ? $berita->created_at->format('Y-m-d H:i:s') : '-'
                ];
            }
        } elseif ($kategori === 'jadwal') {
            $columns = ['No', 'Nama Kegiatan', 'Tanggal', 'Waktu', 'Tempat'];
            $query = Jadwal::query();
            if ($search) $query->where('nama_kegiatan', 'like', "%{$search}%");
            if ($request->filled('bulan')) $query->whereMonth('tanggal_kegiatan', $request->bulan);
            $jadwals = $query->get();
            foreach ($jadwals as $index => $jadwal) {
                $rows[] = [
                    $index + 1,
                    $jadwal->nama_kegiatan,
                    $jadwal->tanggal_kegiatan,
                    $jadwal->waktu,
                    $jadwal->tempat
                ];
            }
        }

        $callback = function() use($columns, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($rows as $row) fputcsv($file, $row);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
