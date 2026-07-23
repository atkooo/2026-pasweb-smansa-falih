<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;
use App\Models\FormulirPendaftaran;
use Illuminate\Http\Request;

class FormulirController extends Controller
{
    public function index()
    {
        $formulir = auth()->user()->formulirPendaftaran;

        if ($formulir) {
            $pendaftaran = $formulir;
            return view('calon.formulir.show', compact('pendaftaran'));
        }

        // Cek status pendaftaran
        $statusInfo = \App\Models\Informasi::where('jenis_info', 'pendaftaran_status')->first();
        if ($statusInfo && $statusInfo->konten === 'tutup') {
            return redirect()->route('dashboard')->with('error', 'Mohon maaf, pendaftaran calon anggota baru saat ini sedang ditutup.');
        }

        return view('calon.formulir.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Cek status pendaftaran
        $statusInfo = \App\Models\Informasi::where('jenis_info', 'pendaftaran_status')->first();
        if ($statusInfo && $statusInfo->konten === 'tutup') {
            return redirect()->route('dashboard')->with('error', 'Mohon maaf, pendaftaran telah ditutup.');
        }

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
        $surat_izin = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_surat_izin'), 'berkas/surat_izin');
        $skd = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_skd'), 'berkas/skd');
        $kk = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_kk'), 'berkas/kk');

        // Ambil tahun aktif
        $tahunInfo = \App\Models\Informasi::where('jenis_info', 'pendaftaran_tahun_aktif')->first();
        $tahunAktif = $tahunInfo ? $tahunInfo->konten : date('Y');

        // Simpan ke DB
        FormulirPendaftaran::create([
            'user_id' => $user->id,
            'tahun_periode' => $tahunAktif,
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

    public function edit()
    {
        $formulir = auth()->user()->formulirPendaftaran;

        if (!$formulir || $formulir->status_pendaftaran != 'revision') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak dapat mengedit formulir ini.');
        }

        return view('calon.formulir.edit', compact('formulir'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $formulir = $user->formulirPendaftaran;

        if (!$formulir || $formulir->status_pendaftaran != 'revision') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak dapat mengedit formulir ini.');
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
            'upload_surat_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'upload_skd' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'upload_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'no_telp_ortu' => 'required|string|max:20',
        ]);

        if ($request->hasFile('upload_surat_izin')) {
            $validated['upload_surat_izin'] = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_surat_izin'), 'berkas/surat_izin');
        }
        if ($request->hasFile('upload_skd')) {
            $validated['upload_skd'] = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_skd'), 'berkas/skd');
        }
        if ($request->hasFile('upload_kk')) {
            $validated['upload_kk'] = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_kk'), 'berkas/kk');
        }

        $validated['status_pendaftaran'] = 'pending';
        $validated['catatan_verifikasi'] = null;

        $formulir->update($validated);

        return redirect()->route('dashboard')->with('success', 'Formulir berhasil diperbarui dan dikirim ulang untuk diverifikasi.');
    }

    public function lengkapiData()
    {
        $user = auth()->user();
        $formulir = $user->formulirPendaftaran;

        if ($formulir && $formulir->is_lengkap && $formulir->status_pendaftaran !== 'revision') {
            return redirect()->route('dashboard')->with('info', 'Data Anda sudah lengkap dan sedang diproses.');
        }

        return view('anggota.lengkapi-data', compact('formulir', 'user'));
    }

    public function storeLengkapiData(Request $request)
    {
        $user = auth()->user();
        $formulir = $user->formulirPendaftaran;

        $hasExistingSuratIzin = $formulir && !empty($formulir->upload_surat_izin);
        $hasExistingSkd = $formulir && !empty($formulir->upload_skd);
        $hasExistingKk = $formulir && !empty($formulir->upload_kk);

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
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'no_telp_ortu' => 'required|string|max:20',
            'upload_surat_izin' => ($hasExistingSuratIzin ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'upload_skd' => ($hasExistingSkd ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'upload_kk' => ($hasExistingKk ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('upload_surat_izin')) {
            $validated['upload_surat_izin'] = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_surat_izin'), 'berkas/surat_izin');
        }
        if ($request->hasFile('upload_skd')) {
            $validated['upload_skd'] = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_skd'), 'berkas/skd');
        }
        if ($request->hasFile('upload_kk')) {
            $validated['upload_kk'] = \App\Helpers\ImageHelper::convertToWebp($request->file('upload_kk'), 'berkas/kk');
        }

        $validated['user_id'] = $user->id;
        $validated['is_lengkap'] = true;
        $validated['status_pendaftaran'] = 'pending';
        $validated['status_kelulusan'] = 'LOLOS';
        $validated['tahun_periode'] = $formulir ? $formulir->tahun_periode : date('Y');

        if ($formulir) {
            $formulir->update($validated);
        } else {
            FormulirPendaftaran::create($validated);
        }

        return redirect()->route('dashboard')->with('success', 'Data profil & berkas Anda berhasil dilengkapi! Menunggu verifikasi admin.');
    }
}
