<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormulirPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'formulir_pendaftaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'asal_sekolah',
        'tinggi_badan',
        'berat_badan',
        'riwayat_penyakit',
        'cita_cita',
        'keterampilan',
        'ekskul_lain',
        'motivasi',
        'opsi_pilihan',
        'motto_hidup',
        'upload_surat_izin',
        'upload_skd',
        'upload_kk',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'no_telp_ortu',
        'status_pendaftaran',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hasilSeleksi(): HasMany
    {
        return $this->hasMany(HasilSeleksi::class);
    }
}
