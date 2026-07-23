<?php

namespace App\Http\Controllers\Calon;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function profil()
    {
        $user = auth()->user()->load(['formulirPendaftaran.hasilSeleksi']);
        $kriterias = \App\Models\Kriteria::orderBy('id', 'asc')->get();
        return view('profil-pengguna.index', compact('user', 'kriterias'));
    }

    public function index()
    {
        $user = auth()->user();
        return view('pengaturan.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $isStaff = in_array($user->role, ['admin', 'pengurus']);

        $rules = [
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'password_lama' => 'nullable|string|min:8',
            'password_baru' => 'nullable|string|min:8|confirmed',
        ];

        if ($isStaff) {
            $rules['nama_lengkap'] = 'required|string|max:255';
            $rules['nisn'] = 'required|string|max:255|unique:users,nisn,' . $user->id;
        }

        $request->validate($rules);

        if ($isStaff) {
            $user->nama_lengkap = $request->nama_lengkap;
            $user->nisn = $request->nisn;
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->foto);
            }
            $user->foto = \App\Helpers\ImageHelper::convertToWebp($request->file('foto'), 'profil_photos');
            $user->save();

            if (!$request->filled('password_baru')) {
                return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
            }
        }

        if ($request->filled('password_lama') && $request->filled('password_baru')) {
            if (!\Illuminate\Support\Facades\Hash::check($request->password_lama, $user->password)) {
                return back()->withErrors(['password_lama' => 'Kata sandi lama tidak sesuai.']);
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password_baru);
        }

        $user->save();

        return redirect()->back()->with('success', 'Pengaturan akun berhasil diperbarui.');
    }

    public function hapusFoto()
    {
        $user = auth()->user();

        if ($user->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->foto);
        }

        $user->foto = null;
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
    }
}
