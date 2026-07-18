<?php

namespace App\Services;

use App\Models\FormulirPendaftaran;

class PendaftaranService
{
    /**
     * Get paginated pendaftarans based on filters (search and status).
     */
    public function getPendaftarans(array $filters = [], $perPage = 10)
    {
        $query = FormulirPendaftaran::with('user')->orderBy('created_at', 'desc');

        if (!empty($filters['status'])) {
            $query->where('status_pendaftaran', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('nama_panggilan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('nama_lengkap', 'like', "%{$search}%")
                         ->orWhere('nisn', 'like', "%{$search}%");
                  });
            });
        }

        return $query->paginate($perPage);
    }

    /**
     * Get a single pendaftaran detail by ID.
     */
    public function getPendaftaranDetail($id)
    {
        return FormulirPendaftaran::with('user')->findOrFail($id);
    }

    /**
     * Update the status of a pendaftaran.
     */
    public function updateStatus($id, $status, $catatan = null)
    {
        $pendaftaran = FormulirPendaftaran::findOrFail($id);
        $pendaftaran->status_pendaftaran = $status;
        $pendaftaran->catatan_verifikasi = $catatan;
        $pendaftaran->save();
        
        return $pendaftaran;
    }
}
