<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ModulController;

// Default Redirect
Route::get('/', fn() => redirect()->route('dashboard.index'));

// DASHBOARD READ (Publik)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// DASHBOARD CU (Admin only)
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/{dashboard}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/{dashboard}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

// PROFIL READ (Publik)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

// PROFIL CU (Admin only)
Route::middleware(['auth', 'verified'])->prefix('profil')->group(function () {
    Route::get('/create', [ProfilController::class, 'create'])->name('profil.create');
    Route::post('/', [ProfilController::class, 'store'])->name('profil.store');
    Route::get('/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/{id}', [ProfilController::class, 'destroy'])->name('profil.destroy');
});

// BERITA READ (Publik)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// BERITA CU
Route::middleware(['auth', 'verified'])->prefix('berita')->group(function () {
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');

    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

// BERITA DETAIL
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// INFORMASI READ (Publik)
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');

// INFORMASI CU
Route::middleware(['auth', 'verified'])->prefix('informasi')->group(function () {
    Route::get('/create', [InformasiController::class, 'create'])->name('informasi.create');
    Route::post('/', [InformasiController::class, 'store'])->name('informasi.store');

    Route::get('/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::put('/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');
});

// INFORMASI DETAIL
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');

// FASILITAS  READ (Publik)
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/fasilitas/umum', [FasilitasController::class, 'umum'])->name('fasilitas.umum');
Route::get('/fasilitas/belajar', [FasilitasController::class, 'belajar'])->name('fasilitas.belajar');
Route::get('/fasilitas/khusus', [FasilitasController::class, 'khusus'])->name('fasilitas.khusus');

// FASILITAS CU
Route::middleware(['auth', 'verified'])->prefix('fasilitas')->group(function () {
    Route::get('/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
    Route::post('/', [FasilitasController::class, 'store'])->name('fasilitas.store');

    Route::get('/{id}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
});

// FASILITAS DETAIL
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');

// GALERI READ (Publik)
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// GALERI CU
Route::middleware(['auth', 'verified'])->prefix('galeri')->group(function () {
    Route::get('/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/', [GaleriController::class, 'store'])->name('galeri.store');

    Route::get('/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

// GALERI DETAIL
Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');

// LINK READ (Publik)
Route::get('/link', [LinkController::class, 'index'])->name('link.index');
Route::get('/sadiklat', [LinkController::class, 'sadiklat'])->name('sadiklat.index');

// LINK CU
Route::middleware(['auth', 'verified'])->prefix('link')->group(function () {
    Route::get('/create', [LinkController::class, 'create'])->name('link.create');
    Route::post('/', [LinkController::class, 'store'])->name('link.store');

    Route::get('/{id}/edit', [LinkController::class, 'edit'])->name('link.edit');
    Route::put('/{id}', [LinkController::class, 'update'])->name('link.update');
    Route::delete('/{id}', [LinkController::class, 'destroy'])->name('link.destroy');
});

// MODUL READ (Publik)
Route::get('/modul', [ModulController::class, 'index'])->name('modul.index');
Route::get('/modul/sip', [ModulController::class, 'sip'])->name('modul.sip');
Route::get('/modul/pag', [ModulController::class, 'pag'])->name('modul.pag');

// MODUL CU (Admin + Personel)
Route::middleware(['auth', 'verified'])->prefix('modul')->group(function () {
    Route::get('/create', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/', [ModulController::class, 'store'])->name('modul.store');
    Route::get('/{id}/edit', [ModulController::class, 'edit'])->name('modul.edit');
    Route::put('/{id}', [ModulController::class, 'update'])->name('modul.update');
    Route::delete('/{id}', [ModulController::class, 'destroy'])->name('modul.destroy');
});

// SEARCH
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

// User Profile (Breeze default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
