<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        // Fetch all formulir that are not rejected
        $pesertas = \App\Models\FormulirPendaftaran::with('user')
            ->where('status_pendaftaran', '!=', 'rejected')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('calon.data_pendaftar.index', compact('pesertas'));
    }
}
