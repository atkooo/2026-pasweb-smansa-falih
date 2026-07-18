<?php

use App\Http\Controllers\Frontend\BeritaController as FrontendBeritaController;
// ==========================================
// 1. FRONTEND ROUTES (Publik)
// ==========================================
use App\Http\Controllers\Frontend\GaleriController as FrontendGaleriController;
use App\Http\Controllers\Frontend\JadwalController as FrontendJadwalController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/sejarah', [PageController::class, 'sejarah'])->name('sejarah');
Route::get('/visi-misi', [PageController::class, 'visiMisi'])->name('visi-misi');
Route::get('/struktur-organisasi', [PageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');

Route::get('/berita', [FrontendBeritaController::class, 'publicIndex'])->name('berita');
Route::get('/berita/{slug}', [FrontendBeritaController::class, 'publicShow'])->name('berita.show');

Route::get('/jadwal', [FrontendJadwalController::class, 'publicIndex'])->name('jadwal');
Route::get('/galeri', [FrontendGaleriController::class, 'publicIndex'])->name('galeri');
Route::get('/galeri/{judul}', [FrontendGaleriController::class, 'publicShow'])->name('galeri.show')->where('judul', '.*');

// ==========================================
// 2. AUTHENTICATION ROUTES
// ==========================================
use App\Http\Controllers\Auth\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->name('register.post');

// ==========================================
// 3. CALON ANGGOTA ROUTES (Dashboard Member)
// ==========================================
use App\Http\Controllers\Calon\FormulirController;
use App\Http\Controllers\Calon\NotifikasiController;
use App\Http\Controllers\Calon\PengaturanController;
use App\Http\Controllers\Calon\PengumumanController as CalonPengumumanController;
use App\Http\Controllers\Calon\PesertaController;
use App\Http\Controllers\Calon\StatusSeleksiController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pendaftaran', [FormulirController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [FormulirController::class, 'store'])->name('pendaftaran.store');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

    Route::get('/status-seleksi', [StatusSeleksiController::class, 'index'])->name('status-seleksi.index');
    Route::get('/status-seleksi/detail/{id}', [StatusSeleksiController::class, 'show'])->name('status-seleksi.show');
    Route::get('/data-pendaftar', [PesertaController::class, 'index'])->name('data-pendaftar.index');
    Route::get('/pengumuman-seleksi', [CalonPengumumanController::class, 'index'])->name('pengumuman-seleksi.index');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

// ==========================================
// 4. ADMIN & PENGURUS ROUTES
// ==========================================
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\SeleksiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::prefix('admin')->middleware('auth')->group(function () {

    // Hanya Admin
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);
        Route::resource('berita', AdminBeritaController::class);
        Route::resource('jadwal', AdminJadwalController::class)->except(['create', 'show', 'edit']);
        Route::get('galeri/album/{judul}', [AdminGaleriController::class, 'adminShow'])->name('galeri.album.show')->where('judul', '.*');
        Route::put('galeri/album/{judul}', [AdminGaleriController::class, 'updateAlbum'])->name('galeri.album.update')->where('judul', '.*');
        Route::delete('galeri/album/{judul}', [AdminGaleriController::class, 'destroyAlbum'])->name('galeri.album.destroy')->where('judul', '.*');
        Route::resource('galeri', AdminGaleriController::class)->except(['create', 'show', 'edit', 'update']);
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
        Route::resource('pengumuman', AdminPengumumanController::class);
    });
});
