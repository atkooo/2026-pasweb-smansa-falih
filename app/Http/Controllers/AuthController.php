<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return View::make('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('nisn', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::intended('/dashboard');
        }

        return Redirect::back()
            ->withInput($request->only('nisn'))
            ->withErrors(['nisn' => 'NISN / NIP atau password salah.']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('login');
    }

    public function showRegisterForm()
    {
        return View::make('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'role' => 'calon_anggota',
        ]);

        return Redirect::route('login')->with('success', 'Akun calon anggota berhasil dibuat. Silakan login dengan NISN dan password Anda.');
    }
}
