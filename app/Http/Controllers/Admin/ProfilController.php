<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\ProfilService;
use App\Http\Requests\StoreProfilRequest;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    protected $profilService;

    public function __construct(ProfilService $profilService)
    {
        $this->profilService = $profilService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = $this->profilService->getAllInformasi();
        return view('admin.profil.index', compact('informasi'));
    }

    /**
     * Store profile updates including images and textual data.
     */
    public function store(StoreProfilRequest $request)
    {
        // Text fields are present in request, service handles checking them
        $this->profilService->updateTextFields($request->all());
        
        // Image fields are processed
        $this->profilService->updateImageFields($request);

        return redirect()->route('profil.index')->with('success', 'Profil website berhasil diperbarui.');
    }
}
