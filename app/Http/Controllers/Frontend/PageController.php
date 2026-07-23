<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ProfilService;

class PageController extends Controller
{
    protected $profilService;

    public function __construct(ProfilService $profilService)
    {
        $this->profilService = $profilService;
    }

    public function home()
    {
        $informasi = $this->profilService->getAllInformasi();
        return view('frontend.home', compact('informasi'));
    }

    public function sejarah()
    {
        $informasi = $this->profilService->getAllInformasi();
        return view('frontend.sejarah', compact('informasi'));
    }

    public function visiMisi()
    {
        $informasi = $this->profilService->getAllInformasi();
        return view('frontend.visi-misi', compact('informasi'));
    }

    public function strukturOrganisasi()
    {
        $informasi = $this->profilService->getAllInformasi();
        return view('frontend.struktur-organisasi', compact('informasi'));
    }
}
