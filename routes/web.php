<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KursMataUangController;

// Rute untuk Halaman Depan
Route::get('/', [KursMataUangController::class, 'index']);
Route::get('/admin', [KursMataUangController::class, 'admin']); // RUTE BARU UNTUK ADMIN
Route::get('/tambah', [KursMataUangController::class, 'tambah']); // Rute untuk buka halaman form
Route::post('/tambah', [KursMataUangController::class, 'simpan']); // Rute untuk memproses form
// RUTE UNTUK EDIT & HAPUS
Route::get('/hapus/{id}', [KursMataUangController::class, 'hapus']);
Route::get('/edit/{id}', [KursMataUangController::class, 'edit']);
Route::post('/edit/{id}', [KursMataUangController::class, 'update']);
