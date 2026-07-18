<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // === PUBLIC METHODS ===
    public function publicIndex()
    {
        $jadwals = Jadwal::orderBy('tanggal_kegiatan', 'asc')->orderBy('waktu', 'asc')->get();
        return view('frontend.jadwal', compact('jadwals'));
    }

    }

    public function index()
    {
        $jadwals = Jadwal::orderBy('tanggal_kegiatan', 'desc')->paginate(10);
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal kegiatan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal kegiatan berhasil dihapus');
    }
}
