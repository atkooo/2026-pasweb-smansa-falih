<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\FormulirPendaftaran;
use Illuminate\Support\Facades\Storage;

class FormulirController extends Controller
{
    public function index()
    {
        $formulir = auth()->user()->formulirPendaftaran;

        if ($formulir) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah mengisi formulir pendaftaran.');
        }

        return view('calon.formulir.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Cek jika sudah punya
        if ($user->formulirPendaftaran) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah mendaftar.');
        }

        $validated = $request->validate([
            'nama_panggilan' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'tinggi_badan' => 'required|integer|min:100|max:250',
            'berat_badan' => 'required|integer|min:30|max:200',
            'riwayat_penyakit' => 'nullable|string',
            'cita_cita' => 'required|string|max:255',
            'keterampilan' => 'nullable|string',
            'ekskul_lain' => 'nullable|string',
            'motivasi' => 'required|string',
            'opsi_pilihan' => 'required|string|max:255',
            'motto_hidup' => 'required|string|max:255',
            'upload_surat_izin' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'upload_skd' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'upload_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'no_telp_ortu' => 'required|string|max:20',
        ]);

        // Simpan File
        $surat_izin = $request->file('upload_surat_izin')->store('berkas/surat_izin', 'public');
        $skd = $request->file('upload_skd')->store('berkas/skd', 'public');
        $kk = $request->file('upload_kk')->store('berkas/kk', 'public');

        // Simpan ke DB
        FormulirPendaftaran::create([
            'user_id' => $user->id,
            'nama_panggilan' => $validated['nama_panggilan'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'agama' => $validated['agama'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
            'asal_sekolah' => $validated['asal_sekolah'],
            'tinggi_badan' => $validated['tinggi_badan'],
            'berat_badan' => $validated['berat_badan'],
            'riwayat_penyakit' => $validated['riwayat_penyakit'],
            'cita_cita' => $validated['cita_cita'],
            'keterampilan' => $validated['keterampilan'],
            'ekskul_lain' => $validated['ekskul_lain'],
            'motivasi' => $validated['motivasi'],
            'opsi_pilihan' => $validated['opsi_pilihan'],
            'motto_hidup' => $validated['motto_hidup'],
            'upload_surat_izin' => $surat_izin,
            'upload_skd' => $skd,
            'upload_kk' => $kk,
            'nama_ayah' => $validated['nama_ayah'],
            'pekerjaan_ayah' => $validated['pekerjaan_ayah'],
            'nama_ibu' => $validated['nama_ibu'],
            'pekerjaan_ibu' => $validated['pekerjaan_ibu'],
            'nama_wali' => $validated['nama_wali'] ?? null,
            'no_telp_ortu' => $validated['no_telp_ortu'],
            'status_pendaftaran' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Formulir berhasil dikirim! Menunggu ulasan panitia.');
    }
}
