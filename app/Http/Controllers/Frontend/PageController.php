<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Informasi;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function sejarah()
    {
        $informasi = Informasi::all()->pluck('konten', 'jenis_info')->toArray();
        return view('frontend.sejarah', compact('informasi'));
    }

    public function visiMisi()
    {
        $informasi = Informasi::all()->pluck('konten', 'jenis_info')->toArray();
        return view('frontend.visi-misi', compact('informasi'));
    }

    public function strukturOrganisasi()
    {
        return view('frontend.struktur-organisasi');
    }
}
