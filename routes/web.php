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

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// READ Dashboard (akses publik)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// CUD Dashboard (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/{dashboard}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/{dashboard}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

// READ Profil (akses publik)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

// CUD Profil (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('profil')->group(function () {
    Route::get('/create', [ProfilController::class, 'create'])->name('profil.create');
    Route::post('/', [ProfilController::class, 'store'])->name('profil.store');
    Route::get('/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/{id}', [ProfilController::class, 'destroy'])->name('profil.destroy');
});

// READ Berita (akses publik)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// CUD Berita (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('berita')->group(function () {
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

// DETAIL Berita (akses publik)
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// READ Informasi (akses publik)
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');

// CUD Informasi (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('informasi')->group(function () {
    Route::get('/create', [InformasiController::class, 'create'])->name('informasi.create');
    Route::post('/', [InformasiController::class, 'store'])->name('informasi.store');
    Route::get('/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::put('/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');
});

// DETAIL Informasi (akses publik)
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');

// READ Fasilitas (akses publik)
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

// KATEGORI Fasilitas (akses publik)
Route::get('/fasilitas/umum', [FasilitasController::class, 'umum'])->name('fasilitas.umum');
Route::get('/fasilitas/belajar', [FasilitasController::class, 'belajar'])->name('fasilitas.belajar');
Route::get('/fasilitas/khusus', [FasilitasController::class, 'khusus'])->name('fasilitas.khusus');

// CUD Fasilitas (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('fasilitas')->group(function () {
    Route::get('/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
    Route::post('/', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/{id}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
});

// DETAIL Fasilitas (akses publik)
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');

// READ Galeri (akses publik)
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// CUD Galeri (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('galeri')->group(function () {
    Route::get('/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

// DETAIL Galeri (akses publik)
Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');

// Route Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

// READ Link (akses publik)
Route::get('/link', [LinkController::class, 'index'])->name('link.index');

// CUD Link (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('link')->group(function () {
    Route::get('/create', [LinkController::class, 'create'])->name('link.create');
    Route::post('/', [LinkController::class, 'store'])->name('link.store');
    Route::get('/{id}/edit', [LinkController::class, 'edit'])->name('link.edit');
    Route::put('/{id}', [LinkController::class, 'update'])->name('link.update');
    Route::delete('/{id}', [LinkController::class, 'destroy'])->name('link.destroy');
});


// Route bawaan Breeze untuk profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
