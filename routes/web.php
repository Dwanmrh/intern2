<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\GaleriController;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// READ (akses publik, tanpa login)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// CUD (akses terbatas, hanya untuk Admin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{dashboard}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{dashboard}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

// Halaman Profil
Route::get('/profil', [PimpinanController::class, 'index'])->middleware(['auth', 'verified'])->name('profil');

// CRUD Pimpinan
Route::middleware(['auth', 'verified'])->prefix('pimpinan')->group(function () {
    Route::get('/', [PimpinanController::class, 'index'])->name('pimpinan.index');
    Route::get('/create', [PimpinanController::class, 'create'])->name('pimpinan.create');
    Route::post('/', [PimpinanController::class, 'store'])->name('pimpinan.store');
    Route::get('/{id}/edit', [PimpinanController::class, 'edit'])->name('pimpinan.edit');
    Route::put('/{id}', [PimpinanController::class, 'update'])->name('pimpinan.update');
    Route::delete('/{id}', [PimpinanController::class, 'destroy'])->name('pimpinan.destroy');
});

// CRUD BERITA
Route::middleware(['auth', 'verified'])->prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('berita');
    Route::get('/add-berita', [BeritaController::class, 'create'])->name('berita.add-berita');
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit-berita');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

// CRUD INFORMASI
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/create', [InformasiController::class, 'create'])->name('informasi.create');
Route::post('/informasi', [InformasiController::class, 'store'])->name('informasi.store');
Route::get('/informasi/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
Route::put('/informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');
Route::delete('/informasi/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');

// CRUD GALERI
Route::middleware(['auth', 'verified'])->prefix('galeri')->group(function () {
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/create-galeri', [GaleriController::class, 'create'])->name('galeri.create-galeri');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit-galeri');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

// Route bawaan Breeze untuk profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
