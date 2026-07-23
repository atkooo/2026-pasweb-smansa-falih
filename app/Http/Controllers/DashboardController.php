<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\FormulirPendaftaran;
use App\Models\Jadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;

        if ($role === 'admin') {
            // Metrics
            $totalPengguna = User::count();
            $totalCalon = User::where('role', 'calon_anggota')->count();
            $totalPengurus = User::where('role', 'pengurus')->count();
            $totalPendaftar = FormulirPendaftaran::count();

            // Timeline: Latest 5 Pendaftaran
            $pendaftarTerbaru = FormulirPendaftaran::with('user')->latest()->take(5)->get();

            // Timeline: Upcoming schedules
            $jadwalMendatang = Jadwal::where('tanggal_kegiatan', '>=', Carbon::today())
                ->orderBy('tanggal_kegiatan', 'asc')
                ->take(3)
                ->get();

            // Chart Data: Pendaftar per hari (Last 7 days)
            $labels = [];
            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $labels[] = $date->translatedFormat('d M');
                $data[] = FormulirPendaftaran::whereDate('created_at', $date)->count();
            }

            return view('admin.dashboard', compact(
                'totalPengguna',
                'totalCalon',
                'totalPengurus',
                'totalPendaftar',
                'pendaftarTerbaru',
                'jadwalMendatang',
                'labels',
                'data'
            ));
        } elseif ($role === 'pengurus') {
            return view('pengurus.dashboard');
        } elseif ($role === 'anggota' || ($user->formulirPendaftaran && $user->formulirPendaftaran->status_kelulusan === 'LOLOS')) {
            $jadwalMendatang = Jadwal::where('tanggal_kegiatan', '>=', Carbon::today())
                ->orderBy('tanggal_kegiatan', 'asc')
                ->take(3)
                ->get();
            $beritaTerbaru = Berita::where('status', 'diterbitkan')
                ->latest()
                ->take(5)
                ->get();
            $formulir = $user->formulirPendaftaran ? $user->formulirPendaftaran->load('hasilSeleksi') : null;
            $kriterias = \App\Models\Kriteria::orderBy('id', 'asc')->get();

            return view('anggota.dashboard', compact('jadwalMendatang', 'beritaTerbaru', 'formulir', 'kriterias'));
        }

        return view('calon.dashboard');
    }
}
