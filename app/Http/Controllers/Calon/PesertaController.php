<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        return view('calon.data_pendaftar.index');
    }
}
