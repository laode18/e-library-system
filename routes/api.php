<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Book routes - accessible by both admin and user for viewing
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/{id}', [BukuController::class, 'show']);
    
    // Admin only routes for books
    Route::middleware('admin')->group(function () {
        Route::post('/buku', [BukuController::class, 'store']);
        Route::put('/buku/{id}', [BukuController::class, 'update']);
        Route::delete('/buku/{id}', [BukuController::class, 'destroy']);
    });
    
    // Category routes - viewing accessible by all authenticated users
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/{id}', [KategoriController::class, 'show']);
    
    // Admin only routes for categories
    Route::middleware('admin')->group(function () {
        Route::post('/kategori', [KategoriController::class, 'store']);
        Route::put('/kategori/{id}', [KategoriController::class, 'update']);
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
    });
    
    // Borrowing routes
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    Route::put('/peminjaman/{id}/return', [PeminjamanController::class, 'returnBook']);
});
