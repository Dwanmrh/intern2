<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// READ Dashboard (akses publik)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// CUD Dashboard (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{dashboard}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{dashboard}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

// READ Profil (akses publik)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

// CUD Profil (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('profil')->group(function () {
    Route::get('/profil/create', [ProfilController::class, 'create'])->name('profil.create');
    Route::post('/profil', [ProfilController::class, 'store'])->name('profil.store');
    Route::get('/profil/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/{id}', [ProfilController::class, 'destroy'])->name('profil.destroy');
});

// READ Berita (akses publik)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// CUD Berita (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('berita')->group(function () {
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

// READ Informasi (akses publik)
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');

// CUD Informasi (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('informasi')->group(function () {
    Route::get('/informasi/create', [InformasiController::class, 'create'])->name('informasi.create');
    Route::post('/informasi', [InformasiController::class, 'store'])->name('informasi.store');
    Route::get('/informasi/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::put('/informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/informasi/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');
});

// READ Fasilitas (akses publik)
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

// CUD Fasilitas (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('fasilitas')->group(function () {
    Route::get('/fasilitas/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/fasilitas/{id}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/fasilitas/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
});

// READ Galeri (akses publik)
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// CUD Galeri (hanya untuk Admin)
Route::middleware(['auth', 'verified'])->prefix('galeri')->group(function () {
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

// Route Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

// Route bawaan Breeze untuk profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
