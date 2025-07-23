<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profil', function () {
    return view('profil');
})->middleware(['auth', 'verified'])->name('profil');

Route::get('/informasi', function () {
    return view('informasi');
})->middleware(['auth', 'verified'])->name('informasi');

Route::get('/berita', function () {
    return view('berita');
})->middleware(['auth', 'verified'])->name('berita');

Route::get('/galeri', function () {
    return view('galeri');
})->middleware(['auth', 'verified'])->name('galeri');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
