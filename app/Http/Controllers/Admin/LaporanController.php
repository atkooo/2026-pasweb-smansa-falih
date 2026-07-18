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
    public function index()
    {
        $stats = [
            'total_admin' => User::where('role', 'admin')->count(),
            'total_pengurus' => User::where('role', 'pengurus')->count(),
            'total_calon' => User::where('role', 'calon_anggota')->count(),
            'total_berita' => Berita::count(),
            'total_berita_diterbitkan' => Berita::where('status', 'diterbitkan')->count(),
            'total_jadwal' => Jadwal::count(),
            'jadwal_bulan_ini' => Jadwal::whereMonth('tanggal_kegiatan', Carbon::now()->month)->count(),
            'total_foto' => Galeri::count(),
        ];

        // We can also fetch the exact schedules for this month to display in a printable table
        $jadwalBulanIni = Jadwal::whereMonth('tanggal_kegiatan', Carbon::now()->month)
                            ->orderBy('tanggal_kegiatan', 'asc')
                            ->get();

        return view('admin.laporan.index', compact('stats', 'jadwalBulanIni'));
    }
}
