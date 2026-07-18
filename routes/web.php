<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\UserFormulirController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\CalonStatusController;
use App\Http\Controllers\CalonPesertaController;
use App\Http\Controllers\CalonPengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/sejarah', function () {
    $informasi = \App\Models\Informasi::all()->pluck('konten', 'jenis_info')->toArray();
    return view('sejarah', compact('informasi'));
})->name('sejarah');

Route::get('/visi-misi', function () {
    $informasi = \App\Models\Informasi::all()->pluck('konten', 'jenis_info')->toArray();
    return view('visi-misi', compact('informasi'));
})->name('visi-misi');

Route::get('/struktur-organisasi', function () {
    return view('struktur-organisasi');
})->name('struktur-organisasi');

// Removed static galeri route

Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'publicShow'])->name('berita.show');

Route::get('/jadwal', [JadwalController::class, 'publicIndex'])->name('jadwal');
Route::get('/galeri', [GaleriController::class, 'publicIndex'])->name('galeri');
Route::get('/galeri/{judul}', [GaleriController::class, 'publicShow'])->name('galeri.show')->where('judul', '.*');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pendaftaran', [UserFormulirController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [UserFormulirController::class, 'store'])->name('pendaftaran.store');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

    // Tambahan Route Calon Anggota
    Route::get('/status-seleksi', [CalonStatusController::class, 'index'])->name('status-seleksi.index');
    Route::get('/status-seleksi/detail/{id}', [CalonStatusController::class, 'show'])->name('status-seleksi.show');
    Route::get('/data-pendaftar', [CalonPesertaController::class, 'index'])->name('data-pendaftar.index');
    Route::get('/pengumuman-seleksi', [CalonPengumumanController::class, 'index'])->name('pengumuman-seleksi.index');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Hanya Admin
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
        Route::resource('berita', BeritaController::class);
        Route::resource('jadwal', JadwalController::class)->except(['create', 'show', 'edit']);
        Route::get('galeri/album/{judul}', [GaleriController::class, 'adminShow'])->name('galeri.album.show')->where('judul', '.*');
        Route::put('galeri/album/{judul}', [GaleriController::class, 'updateAlbum'])->name('galeri.album.update')->where('judul', '.*');
        Route::delete('galeri/album/{judul}', [GaleriController::class, 'destroyAlbum'])->name('galeri.album.destroy')->where('judul', '.*');
        Route::resource('galeri', GaleriController::class)->except(['create', 'show', 'edit', 'update']);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        
        Route::resource('kriteria', KriteriaController::class);
        Route::resource('profil', ProfilController::class);
    });
    
    // Admin & Pengurus
    Route::middleware('admin:admin,pengurus')->group(function () {
        // Pendaftaran Routes
        Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
        Route::get('pendaftaran/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('admin.pendaftaran.verifikasi');
        Route::get('pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
        Route::patch('pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('admin.pendaftaran.updateStatus');

        // Seleksi Routes
        Route::get('seleksi', [SeleksiController::class, 'index'])->name('seleksi.index');
        Route::get('seleksi/{id}', [SeleksiController::class, 'show'])->name('seleksi.show');
        Route::post('seleksi/{id}', [SeleksiController::class, 'store'])->name('seleksi.store');
        Route::delete('seleksi/hasil/{id}', [SeleksiController::class, 'destroy'])->name('seleksi.destroy');

        // Pengumuman Routes
        Route::resource('pengumuman', PengumumanController::class);
    });
});
