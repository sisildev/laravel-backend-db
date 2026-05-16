<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\RiwayatController;
use App\Http\Controllers\Api\PenyakitController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);
Route::post('/auth/google',   [GoogleAuthController::class, 'login']);
Route::get('/penyakit',       [PenyakitController::class, 'index']);
Route::get('/penyakit/{slug}',[PenyakitController::class, 'show']);

// Protected (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout',    [AuthController::class, 'logout']);
    Route::get('/auth/me',         [AuthController::class, 'me']);
    Route::put('/auth/profile',    [AuthController::class, 'updateProfile']);

    Route::get('/riwayat',         [RiwayatController::class, 'index']);
    Route::post('/riwayat',        [RiwayatController::class, 'store']);
    Route::delete('/riwayat/all',  [RiwayatController::class, 'destroyAll']);
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy']);
    Route::get('/riwayat/stats',   [RiwayatController::class, 'stats']);
});