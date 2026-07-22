<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'jadwal';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'waktu',
        'tempat'
    ];
}
