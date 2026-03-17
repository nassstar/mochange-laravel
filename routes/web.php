<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KursMataUangController;
use App\Http\Controllers\AuthController;

// RUTE HALAMAN PUBLIK (Siapa saja bisa akses)
Route::get('/', [KursMataUangController::class, 'index']);
Route::get('/layanan', [KursMataUangController::class, 'layanan']);
Route::get('/kontak', [KursMataUangController::class, 'kontak']);

// RUTE LOGIN & LOGOUT
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

// RUTE ADMIN (DIGEMBOK OLEH MIDDLEWARE 'auth')
Route::middleware('auth')->group(function () {
    // Semua rute di dalam kotak ini wajib login dulu!
    Route::get('/admin', [KursMataUangController::class, 'admin']);
    Route::get('/tambah', [KursMataUangController::class, 'tambah']);
    Route::post('/tambah', [KursMataUangController::class, 'simpan']);
    Route::get('/edit/{id}', [KursMataUangController::class, 'edit']);
    Route::post('/edit/{id}', [KursMataUangController::class, 'update']);
    Route::get('/hapus/{id}', [KursMataUangController::class, 'hapus']);
    Route::get('/cetak', [KursMataUangController::class, 'cetak']);
});
