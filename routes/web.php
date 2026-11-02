<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

// Halaman login untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Proses logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman utama
Route::get('/', function () {
    return redirect()->route('books.index');
});

// CRUD buku hanya dapat diakses setelah login
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
});
