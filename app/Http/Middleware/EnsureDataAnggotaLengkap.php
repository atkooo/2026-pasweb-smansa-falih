<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDataAnggotaLengkap
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->role === 'anggota') {
                $formulir = $user->formulirPendaftaran;

                if (!$formulir || !$formulir->is_lengkap) {
                    if (!$request->routeIs('lengkapi-data.*') && !$request->routeIs('logout')) {
                        return redirect()->route('lengkapi-data.index')
                            ->with('warning', 'Selamat datang! Silakan lengkapi biodata profil & unggah berkas Anda terlebih dahulu untuk dapat mengakses Dashboard Anggota.');
                    }
                } elseif (!in_array($formulir->status_pendaftaran, ['approved'])) {
                    if (!$request->routeIs('pendaftaran.*') && !$request->routeIs('logout')) {
                        return redirect()->route('pendaftaran.index')
                            ->with('warning', 'Akun Anda sedang menunggu verifikasi admin. Silakan tunggu konfirmasi sebelum mengakses dashboard anggota.');
                    }
                }
            }
        }

        return $next($request);
    }
}
