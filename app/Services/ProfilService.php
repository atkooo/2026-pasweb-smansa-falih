<?php

namespace App\Services;

use App\Models\Informasi;

class ProfilService
{
    /**
     * Get all profil information mapped by jenis_info.
     */
    public function getAllInformasi()
    {
        return Informasi::all()->pluck('konten', 'jenis_info')->toArray();
    }

    /**
     * Update textual profile fields.
     */
    public function updateTextFields(array $data)
    {
        $fields = [
            'visi', 'misi',
            'org_kepsek_nama', 'org_pembina_nama',
            'org_kepsek_nip', 'org_pembina_nip',
            'org_ketua_nama', 'org_wakil_nama', 'org_komandan_nama', 'org_sekretaris_nama', 'org_bendahara_nama',
            'org_ketua_kelas', 'org_wakil_kelas', 'org_komandan_kelas', 'org_sekretaris_kelas', 'org_bendahara_kelas',
            'org_div_kesekretariatan_nama', 'org_div_acara_nama', 'org_div_humas_nama', 'org_div_upacara_nama', 'org_div_latihan_nama',
            'org_div_kesekretariatan_kelas', 'org_div_acara_kelas', 'org_div_humas_kelas', 'org_div_upacara_kelas', 'org_div_latihan_kelas',
            'beranda_judul', 'beranda_subjudul', 'beranda_deskripsi',
            'doc1_judul', 'doc2_judul', 'doc3_judul', 'doc4_judul',
            'sejarah_singkat', 'sejarah_p1', 'sejarah_p2',
            'sejarah_umum_p1', 'sejarah_umum_p2', 'sejarah_umum_p3', 'sejarah_umum_p4',
        ];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $konten = $data[$field] ?? '';
                Informasi::updateOrCreate(
                    ['jenis_info' => $field],
                    [
                        'konten' => $konten,
                        'tanggal_update' => now()->toDateString(),
                    ]
                );
            }
        }
    }

    /**
     * Update uploaded image fields.
     */
    public function updateImageFields($request)
    {
        $imageFields = ['gambar_visi', 'gambar_sejarah', 'beranda_background'];

        $org_roles = [
            'org_kepsek', 'org_pembina', 'org_ketua', 'org_wakil', 'org_komandan', 'org_sekretaris', 'org_bendahara',
            'org_div_kesekretariatan', 'org_div_acara', 'org_div_humas', 'org_div_upacara', 'org_div_latihan',
        ];

        foreach ($org_roles as $role) {
            $imageFields[] = $role.'_foto';
        }

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Determine naming prefix based on field
                $prefix = str_replace('gambar_', '', $field);
                $prefix = str_replace('_foto', '', $prefix);

                $filename = time().'_'.$prefix.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/profil'), $filename);

                Informasi::updateOrCreate(
                    ['jenis_info' => $field],
                    [
                        'konten' => 'uploads/profil/'.$filename,
                        'tanggal_update' => now()->toDateString(),
                    ]
                );
            }
        }
    }

    /**
     * Update document fields.
     */
    public function updateDocumentFields($request)
    {
        $docFields = ['doc1_file', 'doc2_file', 'doc3_file', 'doc4_file'];

        foreach ($docFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time().'_'.$field.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/dokumen'), $filename);

                Informasi::updateOrCreate(
                    ['jenis_info' => $field],
                    [
                        'konten' => 'uploads/dokumen/'.$filename,
                        'tanggal_update' => now()->toDateString(),
                    ]
                );
            }
        }
    }
}
