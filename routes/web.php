<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Login untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman utama
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Halaman yang hanya dapat diakses setelah login
Route::middleware('auth')->group(function () {

    // CRUD buku
    Route::resource('books', BookController::class);

    // Pengelolaan pengguna khusus Admin
    Route::get('/users', [UserController::class, 'index'])
        ->middleware('can:manage-users')
        ->name('users.index');
});
