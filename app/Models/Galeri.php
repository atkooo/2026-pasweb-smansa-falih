<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Galeri extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'galeri';

    protected $fillable = [
        'judul_foto',
        'tanggal_pelaksanaan',
        'file_foto',
        'tanggal_upload'
    ];
}
