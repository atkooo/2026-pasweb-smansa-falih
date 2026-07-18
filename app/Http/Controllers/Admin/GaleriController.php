<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Galeri;
use App\Services\GaleriService;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    protected $galeriService;

    public function __construct(GaleriService $galeriService)
    {
        $this->galeriService = $galeriService;
    }

    // === PUBLIC METHODS ===
    public function publicIndex()
    {
        $albums = $this->galeriService->getAlbums();
        return view('galeri', compact('albums'));
    }

    public function publicShow($judul)
    {
        $judul = urldecode($judul);
        $photos = $this->galeriService->getPhotosByAlbum($judul);
        
        if($photos->isEmpty()) abort(404);
        
        return view('galeri-album', compact('judul', 'photos'));
    }

    // === ADMIN METHODS ===
    public function index()
    {
        $albums = $this->galeriService->getAlbums();
        return view('admin.galeri.index', compact('albums'));
    }

    public function store(StoreGaleriRequest $request)
    {
        if ($request->hasFile('file_foto')) {
            $this->galeriService->storePhotos(
                $request->validated(), 
                $request->file('file_foto')
            );
        }

        return redirect()->route('galeri.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri');
    }

    public function adminShow($judul)
    {
        $judul = urldecode($judul);
        $photos = $this->galeriService->getPhotosByAlbum($judul);
        
        if($photos->isEmpty()) {
            return redirect()->route('galeri.index')
                ->with('success', 'Album kosong. Anda telah dialihkan kembali ke daftar galeri.');
        }
        
        return view('admin.galeri.show', compact('judul', 'photos'));
    }

    public function updateAlbum(UpdateGaleriRequest $request, $judul)
    {
        $judul = urldecode($judul);
        
        $this->galeriService->updateAlbum($judul, $request->validated());

        return redirect()->route('galeri.index')
            ->with('success', 'Detail album berhasil diperbarui');
    }

    public function destroyAlbum($judul)
    {
        $judul = urldecode($judul);
        
        $this->galeriService->deleteAlbum($judul);

        return redirect()->route('galeri.index')
            ->with('success', 'Album beserta seluruh fotonya berhasil dihapus');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        $this->galeriService->deletePhoto($galeri);

        return redirect()->back()
            ->with('success', 'Foto berhasil dihapus dari galeri');
    }
}
