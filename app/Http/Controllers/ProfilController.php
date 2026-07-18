<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = \App\Models\Informasi::all()->pluck('konten', 'jenis_info')->toArray();
        return view('admin.profil.index', compact('informasi'));
    }

    public function store(Request $request)
    {
        $fields = [
            'visi', 'misi',
            'org_kepsek_nama', 'org_pembina_nama',
            'org_kepsek_nip', 'org_pembina_nip',
            'org_ketua_nama', 'org_wakil_nama', 'org_komandan_nama', 'org_sekretaris_nama', 'org_bendahara_nama',
            'org_ketua_kelas', 'org_wakil_kelas', 'org_komandan_kelas', 'org_sekretaris_kelas', 'org_bendahara_kelas',
            'org_div_kesekretariatan_nama', 'org_div_acara_nama', 'org_div_humas_nama', 'org_div_upacara_nama', 'org_div_latihan_nama',
            'org_div_kesekretariatan_kelas', 'org_div_acara_kelas', 'org_div_humas_kelas', 'org_div_upacara_kelas', 'org_div_latihan_kelas'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $konten = $request->input($field) ?? '';
                \App\Models\Informasi::updateOrCreate(
                    ['jenis_info' => $field],
                    [
                        'konten' => $konten,
                        'tanggal_update' => now()->toDateString()
                    ]
                );
            }
        }

        $messages = [
            'image' => 'File yang diunggah harus berupa gambar.',
            'mimes' => 'Format gambar harus berupa jpeg, png, jpg, atau gif.',
            'max' => 'Ukuran gambar tidak boleh melebihi 10MB.'
        ];

        if ($request->hasFile('gambar_visi')) {
            $request->validate(['gambar_visi' => 'image|mimes:jpeg,png,jpg,gif|max:10240'], $messages);
            $file = $request->file('gambar_visi');
            $filename = time() . '_visi.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profil'), $filename);
            \App\Models\Informasi::updateOrCreate(['jenis_info' => 'gambar_visi'], ['konten' => 'uploads/profil/' . $filename, 'tanggal_update' => now()->toDateString()]);
        }

        if ($request->hasFile('gambar_sejarah')) {
            $request->validate(['gambar_sejarah' => 'image|mimes:jpeg,png,jpg,gif|max:10240'], $messages);
            $file = $request->file('gambar_sejarah');
            $filename = time() . '_sejarah.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profil'), $filename);
            \App\Models\Informasi::updateOrCreate(['jenis_info' => 'gambar_sejarah'], ['konten' => 'uploads/profil/' . $filename, 'tanggal_update' => now()->toDateString()]);
        }

        $org_roles = [
            'org_kepsek', 'org_pembina', 'org_ketua', 'org_wakil', 'org_komandan', 'org_sekretaris', 'org_bendahara',
            'org_div_kesekretariatan', 'org_div_acara', 'org_div_humas', 'org_div_upacara', 'org_div_latihan'
        ];

        foreach ($org_roles as $role) {
            $foto_field = $role . '_foto';
            if ($request->hasFile($foto_field)) {
                $request->validate([$foto_field => 'image|mimes:jpeg,png,jpg,gif|max:10240'], $messages);
                $file = $request->file($foto_field);
                $filename = time() . "_{$role}." . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/profil'), $filename);
                \App\Models\Informasi::updateOrCreate(['jenis_info' => $foto_field], ['konten' => 'uploads/profil/' . $filename, 'tanggal_update' => now()->toDateString()]);
            }
        }

        return redirect()->route('profil.index')->with('success', 'Profil website berhasil diperbarui.');
    }
}
