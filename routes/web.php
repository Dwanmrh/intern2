<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\UserController;


// Default Redirect
Route::get('/', fn() => redirect()->route('dashboard.index'));

// OTP
Route::get('/otp', [OtpController::class, 'showForm'])->name('auth.otp.form');
Route::post('/otp', [OtpController::class, 'verify'])->name('auth.otp.verify');
Route::post('/otp/resend', [OtpController::class, 'resend'])->name('auth.otp.resend');

// DASHBOARD READ (Publik)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// DASHBOARD PREVIEW CUD (Admin only)
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/{dashboard}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/{dashboard}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/{dashboard}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

// DASHBOARD LINKS CUD (Admin only)
Route::middleware(['auth', 'verified'])->prefix('dashboard/link')->name('dashboard.link.')->group(function () {
    Route::get('/create', [DashboardController::class, 'linkCreate'])->name('create');
    Route::post('/', [DashboardController::class, 'linkStore'])->name('store');
    Route::get('/{id}/edit', [DashboardController::class, 'linkEdit'])->name('edit');
    Route::put('/{id}', [DashboardController::class, 'linkUpdate'])->name('update');
    Route::delete('/{id}', [DashboardController::class, 'linkDestroy'])->name('destroy');
});

// PROFIL READ (Publik)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

// PROFIL CUD (Admin only)
Route::middleware(['auth', 'verified'])->prefix('profil')->group(function () {
    Route::get('/create', [ProfilController::class, 'create'])->name('profil.create');
    Route::post('/', [ProfilController::class, 'store'])->name('profil.store');
    Route::get('/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/{id}', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/{id}', [ProfilController::class, 'destroy'])->name('profil.destroy');
});

// BERITA READ (Publik)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');

// BERITA CUD (Admin Only)
Route::middleware(['auth', 'verified'])->prefix('berita')->group(function () {
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

// BERITA LIKE (hanya user login yang boleh)
Route::post('/like/{id}', [LikeController::class, 'toggle'])->middleware('auth')->name('berita.like');

// BERITA DETAIL
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');

// INFORMASI READ (Publik)
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

// INFORMASI CUD (Admin Only)
Route::middleware(['auth', 'verified'])->prefix('informasi')->group(function () {
    Route::get('/create', [InformasiController::class, 'create'])->name('informasi.create');
    Route::post('/', [InformasiController::class, 'store'])->name('informasi.store');
    Route::get('/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::put('/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');
});

// INFORMASI JADWAL CUD (Admin Only)
Route::resource('jadwal', JadwalController::class)->except(['index']);

// FASDIK  READ (Publik)
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

// FASDIK CUD (Admin Only)
Route::middleware(['auth', 'verified'])->prefix('fasilitas')->group(function () {
    Route::get('/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
    Route::post('/', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/{id}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
});

// MODUL READ (Login Only, role: Siswa, Personel, Admin)
Route::get('/modul', [ModulController::class, 'index'])->name('modul.index');
Route::get('/modul/sip', [ModulController::class, 'sip'])->name('modul.sip');
Route::get('/modul/pag', [ModulController::class, 'pag'])->name('modul.pag');

// MODUL CUD (Admin only)
Route::middleware(['auth', 'verified'])->prefix('modul')->group(function () {
    Route::get('/create', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/', [ModulController::class, 'store'])->name('modul.store');
    Route::get('/{modul}/edit', [ModulController::class, 'edit'])->name('modul.edit');   // ✅ pakai {modul}
    Route::put('/{modul}', [ModulController::class, 'update'])->name('modul.update');    // ✅ pakai {modul}
    Route::delete('/{modul}', [ModulController::class, 'destroy'])->name('modul.destroy'); // ✅ pakai {modul}
});

// USERS ALL DELETE
Route::delete('/users/destroy-all', [UserController::class, 'destroyAll'])->name('users.destroyAll');

// USERS CRUD (Super Admin Only)
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
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
