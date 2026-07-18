<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // === PUBLIC METHODS ===
    public function publicIndex()
    {
        $albums = Galeri::select('judul_foto', \Illuminate\Support\Facades\DB::raw('MAX(tanggal_pelaksanaan) as tanggal_pelaksanaan'), \Illuminate\Support\Facades\DB::raw('MAX(tanggal_upload) as last_upload'), \Illuminate\Support\Facades\DB::raw('COUNT(id) as photo_count'), \Illuminate\Support\Facades\DB::raw('MAX(file_foto) as cover_photo'))
            ->groupBy('judul_foto')
            ->orderBy('last_upload', 'desc')
            ->paginate(12);
        return view('galeri', compact('albums'));
    }

    public function publicShow($judul)
    {
        $judul = urldecode($judul);
        $photos = Galeri::where('judul_foto', $judul)->orderBy('tanggal_upload', 'desc')->get();
        if($photos->isEmpty()) abort(404);
        return view('galeri-album', compact('judul', 'photos'));
    }

    // === ADMIN METHODS ===
    public function index()
    {
        $albums = Galeri::select('judul_foto', \Illuminate\Support\Facades\DB::raw('MAX(tanggal_pelaksanaan) as tanggal_pelaksanaan'), \Illuminate\Support\Facades\DB::raw('MAX(tanggal_upload) as last_upload'), \Illuminate\Support\Facades\DB::raw('COUNT(id) as photo_count'), \Illuminate\Support\Facades\DB::raw('MAX(file_foto) as cover_photo'))
            ->groupBy('judul_foto')
            ->orderBy('last_upload', 'desc')
            ->paginate(12);
        return view('admin.galeri.index', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_foto' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'file_foto' => 'required|array',
            'file_foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max per image
        ], [
            'tanggal_pelaksanaan.required' => 'Tanggal pelaksanaan kegiatan wajib diisi.',
            'file_foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'file_foto.*.image' => 'File yang diunggah harus berupa gambar.',
            'file_foto.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'file_foto.*.max' => 'Ukuran salah satu foto Anda terlalu besar! Maksimal 10 MB per foto.',
        ]);

        $judul = $request->input('judul_foto');
        $tanggal_pelaksanaan = $request->input('tanggal_pelaksanaan');

        if ($request->hasFile('file_foto')) {
            foreach ($request->file('file_foto') as $file) {
                $path = $file->store('galeri', 'public');
                Galeri::create([
                    'judul_foto' => $judul,
                    'tanggal_pelaksanaan' => $tanggal_pelaksanaan,
                    'file_foto' => $path,
                    'tanggal_upload' => now()
                ]);
            }
        }

        return redirect()->route('galeri.index')->with('success', 'Foto berhasil ditambahkan ke galeri');
    }

    public function adminShow($judul)
    {
        $judul = urldecode($judul);
        $photos = Galeri::where('judul_foto', $judul)->orderBy('tanggal_upload', 'desc')->get();
        if($photos->isEmpty()) {
            return redirect()->route('galeri.index')->with('success', 'Album kosong. Anda telah dialihkan kembali ke daftar galeri.');
        }
        return view('admin.galeri.show', compact('judul', 'photos'));
    }

    public function updateAlbum(Request $request, $judul)
    {
        $judul = urldecode($judul);
        $request->validate([
            'judul_foto' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
        ], [
            'tanggal_pelaksanaan.required' => 'Tanggal pelaksanaan kegiatan wajib diisi.',
        ]);

        Galeri::where('judul_foto', $judul)->update([
            'judul_foto' => $request->judul_foto,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan
        ]);

        return redirect()->route('galeri.index')->with('success', 'Detail album berhasil diperbarui');
    }

    public function destroyAlbum($judul)
    {
        $judul = urldecode($judul);
        $galeris = Galeri::where('judul_foto', $judul)->get();
        
        foreach($galeris as $galeri) {
            if ($galeri->file_foto && Storage::disk('public')->exists($galeri->file_foto)) {
                Storage::disk('public')->delete($galeri->file_foto);
            }
        }
        
        Galeri::where('judul_foto', $judul)->delete();

        return redirect()->route('galeri.index')->with('success', 'Album beserta seluruh fotonya berhasil dihapus');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        if ($galeri->file_foto && Storage::disk('public')->exists($galeri->file_foto)) {
            Storage::disk('public')->delete($galeri->file_foto);
        }
        
        $galeri->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus dari galeri');
    }
}
