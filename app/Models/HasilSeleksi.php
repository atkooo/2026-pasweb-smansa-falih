<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;

class HasilSeleksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hasil_seleksi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'formulir_pendaftaran_id',
        'jenis_seleksi',
        'nilai',
        'status_lulus',
        'keterangan',
    ];

    public function formulirPendaftaran(): BelongsTo
    {
        return $this->belongsTo(FormulirPendaftaran::class);
    }
}
