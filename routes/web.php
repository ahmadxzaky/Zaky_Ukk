<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ReviewController;

// AUTHENTICATION
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Buku
    Route::resource('/books', BookController::class)->names('admin.books');

    // Manajemen User
    Route::resource('/users', UserController::class)->names('admin.users');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
});

// petugas
Route::middleware(['auth', 'role:officer'])->prefix('officers')->group(function () {
    Route::get('/dashboard', [OfficerController::class, 'index'])->name('officers.dashboard');
    Route::put('/{id}', [OfficerController::class, 'update'])->name('officers.update');
    Route::delete('/{id}', [OfficerController::class, 'destroy'])->name('officers.destroy');

    // buku
    Route::get('/books', [BookController::class, 'index'])->name('officers.books.index');
});

// pengunnjunga
Route::middleware(['auth', 'role:visitor'])->prefix('visitor')->group(function () {
    Route::get('/index', [VisitorController::class, 'index'])->name('visitor.index');

    //
    Route::post('/books/{book}/review', [ReviewController::class, 'store'])->name('books.review.store');
});

// LOAN UMUM (semua role yang sudah login bisa akses)
Route::middleware('auth')->group(function () {
    Route::resource('/loans', LoanController::class)
        ->except(['show']) // Hindari error jika method show tidak tersedia
        ->names([
            'index' => 'loans.index',
            'create' => 'loans.create',
            'store' => 'loans.store',
            'edit' => 'admin.loans.edit',
            'update' => 'admin.loans.update',
            'destroy' => 'admin.loans.destroy',
        ]);

    // Kembalikan Buku
    Route::put('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return.shared');

    // Export PDF
    Route::get('/loans/pdf', [LoanController::class, 'exportPdf'])->name('loans.export.pdf');
});
