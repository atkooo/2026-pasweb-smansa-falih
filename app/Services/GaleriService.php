<?php

namespace App\Services;

use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GaleriService
{
    /**
     * Get all albums with their details for index pages.
     */
    public function getAlbums($perPage = 12)
    {
        return Galeri::select(
                'judul_foto',
                DB::raw('MAX(tanggal_pelaksanaan) as tanggal_pelaksanaan'),
                DB::raw('MAX(tanggal_upload) as last_upload'),
                DB::raw('COUNT(id) as photo_count'),
                DB::raw('MAX(file_foto) as cover_photo')
            )
            ->groupBy('judul_foto')
            ->orderBy('last_upload', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get photos for a specific album by its title.
     */
    public function getPhotosByAlbum($judul)
    {
        return Galeri::where('judul_foto', $judul)
            ->orderBy('tanggal_upload', 'desc')
            ->get();
    }

    /**
     * Store new photos to the gallery.
     */
    public function storePhotos(array $data, array $files)
    {
        DB::transaction(function () use ($data, $files) {
            foreach ($files as $file) {
                $path = \App\Helpers\ImageHelper::convertToWebp($file, 'galeri');
                Galeri::create([
                    'judul_foto' => $data['judul_foto'],
                    'tanggal_pelaksanaan' => $data['tanggal_pelaksanaan'],
                    'file_foto' => $path,
                    'tanggal_upload' => now()
                ]);
            }
        });
    }

    /**
     * Update album details.
     */
    public function updateAlbum($judul, array $data)
    {
        return Galeri::where('judul_foto', $judul)->update([
            'judul_foto' => $data['judul_foto'],
            'tanggal_pelaksanaan' => $data['tanggal_pelaksanaan']
        ]);
    }

    /**
     * Delete an entire album and its photos.
     */
    public function deleteAlbum($judul)
    {
        $galeris = Galeri::where('judul_foto', $judul)->get();
        
        foreach($galeris as $galeri) {
            $this->deletePhotoFile($galeri->file_foto);
        }
        
        return Galeri::where('judul_foto', $judul)->delete();
    }

    /**
     * Delete a single photo from the gallery.
     */
    public function deletePhoto(Galeri $galeri)
    {
        $this->deletePhotoFile($galeri->file_foto);
        return $galeri->delete();
    }

    /**
     * Delete a photo file from storage.
     */
    private function deletePhotoFile($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
