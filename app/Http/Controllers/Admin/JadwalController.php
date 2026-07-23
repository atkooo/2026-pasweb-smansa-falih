<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // === PUBLIC METHODS ===
    public function publicIndex()
    {
        $jadwals = Jadwal::orderBy('created_at', 'asc')->get();
        return view('jadwal', compact('jadwals'));
    }

    // === ADMIN METHODS ===
    public function index()
    {
        $jadwals = Jadwal::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        Jadwal::create($request->only(['nama_kegiatan', 'deskripsi']));

        return redirect()->route('jadwal.index')->with('success', 'Jadwal kegiatan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        $jadwal->update($request->only(['nama_kegiatan', 'deskripsi']));

        return redirect()->route('jadwal.index')->with('success', 'Jadwal kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal kegiatan berhasil dihapus');
    }
}
