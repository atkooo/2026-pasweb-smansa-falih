<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = auth()->user()->role;
        
        if ($role === 'admin') {
            return view('admin.dashboard');
        } elseif ($role === 'pengurus') {
            return view('pengurus.dashboard');
        }
        
        return view('calon.dashboard');
    }
}
