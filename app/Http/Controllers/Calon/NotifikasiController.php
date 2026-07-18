<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Informasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $formulir = auth()->user()->formulirPendaftaran;
        
        // Ambil semua informasi (pengumuman global)
        $pengumuman = Informasi::orderBy('tanggal_update', 'desc')->get();

        return view('calon.notifikasi.index', compact('formulir', 'pengumuman'));
    }
}
