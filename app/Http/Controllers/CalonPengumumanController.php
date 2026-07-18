<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalonPengumumanController extends Controller
{
    public function index()
    {
        return view('calon.pengumuman.index');
    }
}
