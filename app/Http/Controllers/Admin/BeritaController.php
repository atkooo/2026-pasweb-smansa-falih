<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // === PUBLIC METHODS ===
    public function publicIndex()
    {
        $beritas = Berita::where('status', 'diterbitkan')->latest()->paginate(9);
        return view('berita', compact('beritas'));
    }

    public function publicShow($slug)
    {
        $berita = Berita::where('slug', $slug)->where('status', 'diterbitkan')->firstOrFail();
        return view('berita-show', compact('berita'));
    }

    // === ADMIN METHODS ===
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required|string',
            'status' => 'required|in:diterbitkan,draf'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul) . '-' . time();

        if ($request->hasFile('gambar_sampul')) {
            $path = $request->file('gambar_sampul')->store('berita', 'public');
            $data['gambar_sampul'] = $path;
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required|string',
            'status' => 'required|in:diterbitkan,draf'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul) . '-' . time();

        if ($request->hasFile('gambar_sampul')) {
            // Delete old image
            if ($berita->gambar_sampul && Storage::disk('public')->exists($berita->gambar_sampul)) {
                Storage::disk('public')->delete($berita->gambar_sampul);
            }
            $path = $request->file('gambar_sampul')->store('berita', 'public');
            $data['gambar_sampul'] = $path;
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->gambar_sampul && Storage::disk('public')->exists($berita->gambar_sampul)) {
            Storage::disk('public')->delete($berita->gambar_sampul);
        }
        
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
