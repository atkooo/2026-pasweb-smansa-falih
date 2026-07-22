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

                // Jika belum punya formulir atau is_lengkap == false
                if (!$formulir || !$formulir->is_lengkap) {
                    if (!$request->routeIs('lengkapi-data.*') && !$request->routeIs('logout')) {
                        return redirect()->route('lengkapi-data.index')
                            ->with('warning', 'Selamat datang! Silakan lengkapi biodata profil & unggah berkas Anda terlebih dahulu untuk dapat mengakses Dashboard Anggota.');
                    }
                }
            }
        }

        return $next($request);
    }
}
