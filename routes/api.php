<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KibMesinController;
use App\Http\Controllers\KibTanahController;
use App\Http\Controllers\KibGedungController;
use App\Http\Controllers\LaporanController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/kir/cetak', [LaporanController::class, 'cetak']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('kib-tanah', KibTanahController::class);
    Route::apiResource('kib-mesin', KibMesinController::class);
    Route::apiResource('kib-gedung', KibGedungController::class);
    Route::apiResource('kir', KirController::class);
    Route::post('/kir/cetak-label', [KirController::class, 'cetakLabel']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/kib-tanah/import', [KibTanahController::class, 'importExcel']);
    Route::post('/kib-gedung/import', [KibGedungController::class, 'importExcel']);
    Route::post('/kib-mesin/import', [KibMesinController::class, 'importExcel']);

    Route::get('/laporan/rekap-aset', [LaporanController::class, 'rekapAset']);
});
