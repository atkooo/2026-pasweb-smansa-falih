<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function profil()
    {
        $user = auth()->user();
        return view('profil-pengguna.index', compact('user'));
    }

    public function index()
    {
        $user = auth()->user();
        return view('pengaturan.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password_lama' => 'nullable|string|min:8',
            'password_baru' => 'nullable|string|min:8|confirmed',
        ]);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password_lama') && $request->filled('password_baru')) {
            if (!\Illuminate\Support\Facades\Hash::check($request->password_lama, $user->password)) {
                return back()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai.']);
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password_baru);
        }

        $user->save();

        return redirect()->route('pengaturan.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
