<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('formulirPendaftaran')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($user->role === 'anggota') {
            $namaPanggilan = explode(' ', trim($user->nama_lengkap))[0];
            \App\Models\FormulirPendaftaran::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_panggilan' => $namaPanggilan,
                    'tempat_lahir' => '-',
                    'tanggal_lahir' => date('Y-m-d'),
                    'agama' => 'Islam',
                    'jenis_kelamin' => 'Laki-laki',
                    'no_hp' => '-',
                    'alamat' => '-',
                    'asal_sekolah' => 'SMA Negeri 1 Pontianak',
                    'tinggi_badan' => 170,
                    'berat_badan' => 60,
                    'riwayat_penyakit' => '-',
                    'cita_cita' => '-',
                    'motivasi' => 'Anggota Resmi Paskibra SMAN 1 Pontianak',
                    'opsi_pilihan' => 'YA',
                    'motto_hidup' => '-',
                    'upload_surat_izin' => '',
                    'upload_skd' => '',
                    'upload_kk' => '',
                    'status_pendaftaran' => 'approved',
                    'status_kelulusan' => 'LOLOS',
                    'is_lengkap' => false,
                    'tahun_periode' => date('Y'),
                ]
            );
        }

        return redirect()->route('users.index')->with('success', 'Pengguna/Anggota berhasil ditambahkan.');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if ($user->role === 'anggota') {
            $namaPanggilan = explode(' ', trim($user->nama_lengkap))[0];
            $fp = \App\Models\FormulirPendaftaran::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_panggilan' => $namaPanggilan,
                    'tempat_lahir' => 'Pontianak',
                    'tanggal_lahir' => '2008-01-01',
                    'agama' => 'Islam',
                    'jenis_kelamin' => 'Laki-Laki',
                    'no_hp' => '-',
                    'alamat' => 'SMA Negeri 1 Pontianak',
                    'asal_sekolah' => 'SMA Negeri 1 Pontianak',
                    'tinggi_badan' => 170,
                    'berat_badan' => 60,
                    'riwayat_penyakit' => 'Tidak Ada',
                    'cita_cita' => '-',
                    'motivasi' => 'Anggota Resmi Paskibra SMAN 1 Pontianak',
                    'opsi_pilihan' => 'YA',
                    'motto_hidup' => 'Disiplin, Setia, Berani',
                    'upload_surat_izin' => 'default.pdf',
                    'upload_skd' => 'default.pdf',
                    'upload_kk' => 'default.pdf',
                    'status_pendaftaran' => 'approved',
                    'status_kelulusan' => 'LOLOS',
                    'tahun_periode' => date('Y'),
                ]
            );

            if ($fp->status_kelulusan !== 'LOLOS') {
                $fp->status_kelulusan = 'LOLOS';
                $fp->save();
            }
        }

        return redirect()->route('users.index')->with('success', 'Data pengguna/anggota berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
