<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = \App\Models\Pengumuman::orderBy('created_at', 'desc')->get();
        return view('calon.pengumuman.index', compact('pengumumans'));
    }
}
