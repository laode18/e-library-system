<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\BukuController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\PeminjamanController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/test-create-view', function () {
    //     return view('books.create', ['categories' => \App\Models\Kategori::all()]);
    // });

    
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('/books/create', [BukuController::class, 'create'])->name('books.create');
        Route::post('/books', [BukuController::class, 'store'])->name('books.store');
        Route::get('/books/{id}/edit', [BukuController::class, 'edit'])->name('books.edit');
        Route::put('/books/{id}', [BukuController::class, 'update'])->name('books.update');
        Route::delete('/books/{id}', [BukuController::class, 'destroy'])->name('books.destroy');

        // Route::resource('books', BukuController::class);
        
        // Categories
        Route::resource('categories', KategoriController::class);
        
        // All borrowings (admin view)
        Route::get('/borrowings/all', [PeminjamanController::class, 'adminIndex'])->name('borrowings.admin');
    });

    // Book routes
    Route::get('/books', [BukuController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BukuController::class, 'show'])->name('books.show');
    
    // Borrowing routes
    Route::get('/borrowings', [PeminjamanController::class, 'index'])->name('borrowings.index');
    Route::post('/borrowings', [PeminjamanController::class, 'store'])->name('borrowings.store');
    Route::put('/borrowings/{id}/return', [PeminjamanController::class, 'returnBook'])->name('borrowings.return');
});
