<?php

namespace App\Services;

use App\Models\FormulirPendaftaran;
use App\Models\HasilSeleksi;
use App\Models\Kriteria;

class SeleksiService
{
    /**
     * Get all criteria sorted by ID.
     */
    public function getAllKriteria()
    {
        return Kriteria::orderBy('id', 'asc')->get();
    }

    /**
     * Get paginated participants with their final scores calculated.
     */
    public function getPesertaWithScores($filters = [], $perPage = 10)
    {
        $kriterias = $this->getAllKriteria();

        $query = FormulirPendaftaran::with(['user', 'hasilSeleksi'])
                    ->where('status_pendaftaran', 'approved')
                    ->orderBy('created_at', 'desc');

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
        
        if (!empty($filters['tahun_periode'])) {
            $query->where('tahun_periode', $filters['tahun_periode']);
        }

        $pesertas = $query->paginate($perPage);
        
        $pesertas->getCollection()->transform(function($p) use ($kriterias) {
            $nilai_akhir = 0;
            $temp_nilai = [];

            foreach ($kriterias as $k) {
                // Get the score for this specific criteria
                $hasil = $p->hasilSeleksi->where('jenis_seleksi', $k->nama)->first();
                $nilai = floatval($hasil->nilai ?? 0);
                
                // Store in array for view rendering
                $temp_nilai[$k->id] = $nilai;

                // Calculate final score using weight
                $nilai_akhir += ($nilai * ($k->bobot / 100));
            }
            
            $p->setAttribute('nilai_kriteria', $temp_nilai);
            $p->setAttribute('nilai_akhir', $nilai_akhir);
            
            return $p;
        });

        return $pesertas;
    }

    /**
     * Get all distinct tahun_periode from pendaftarans.
     */
    public function getAvailableTahun()
    {
        return FormulirPendaftaran::select('tahun_periode')
            ->whereNotNull('tahun_periode')
            ->distinct()
            ->orderBy('tahun_periode', 'desc')
            ->pluck('tahun_periode');
    }

    /**
     * Get a single participant for the detail view.
     */
    public function getPendaftaranDetail($id)
    {
        return FormulirPendaftaran::with(['user', 'hasilSeleksi' => function($q) {
            $q->orderBy('created_at', 'desc');
        }])->findOrFail($id);
    }

    /**
     * Store selection score for a participant.
     */
    public function storeScore($pendaftaranId, array $data)
    {
        $pendaftaran = FormulirPendaftaran::findOrFail($pendaftaranId);
        
        $kriteria = Kriteria::where('nama', $data['jenis_seleksi'])->first();
        $statusLulus = 'tidak_lulus';
        if ($kriteria && floatval($data['nilai']) >= $kriteria->nilai_minimal_lulus) {
            $statusLulus = 'lulus';
        }

        return HasilSeleksi::updateOrCreate(
            [
                'formulir_pendaftaran_id' => $pendaftaran->id,
                'jenis_seleksi' => $data['jenis_seleksi'],
            ],
            [
                'nilai' => $data['nilai'],
                'status_lulus' => $statusLulus,
                'keterangan' => $data['keterangan'] ?? null,
            ]
        );
    }

    /**
     * Delete a selection score.
     */
    public function deleteScore($id)
    {
        $hasil = HasilSeleksi::findOrFail($id);
        return $hasil->delete();
    }

    /**
     * Set final graduation status.
     */
    public function setKelulusan($pendaftaranId, $status)
    {
        $pendaftaran = FormulirPendaftaran::with('user')->findOrFail($pendaftaranId);
        $pendaftaran->status_kelulusan = $status;
        $saved = $pendaftaran->save();

        // Update role user secara eksplisit via User model langsung
        if ($pendaftaran->user_id) {
            $user = \App\Models\User::find($pendaftaran->user_id);
            if ($user) {
                $user->role = ($status === 'LOLOS') ? 'anggota' : 'calon_anggota';
                $user->save();
            }
        }

        return $saved;
    }
}
