<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('calon.pengumuman.index');
    }
}
