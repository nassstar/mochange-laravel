<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KursApiController;

// RUTE FULL CRUD API MOCHANGE
Route::get('/kurs', [KursApiController::class, 'index']);           // Tampilkan semua
Route::get('/kurs/{id}', [KursApiController::class, 'show']);       // Tampilkan satu detail
Route::post('/kurs', [KursApiController::class, 'store']);          // Simpan data baru
Route::post('/kurs/{id}', [KursApiController::class, 'update']);    // Edit data
Route::delete('/kurs/{id}', [KursApiController::class, 'destroy']); // Hapus data
