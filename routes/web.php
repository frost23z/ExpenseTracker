<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transaction', function () {
    return view('transaction');
})->middleware(['auth', 'verified'])->name('transaction');

Route::get('/transactions', [TransactionController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/transactions/create', [TransactionController::class, 'create'])->middleware(['auth', 'verified'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->middleware(['auth', 'verified'])->name('transactions.store');

Route::get('/summary', [TransactionController::class, 'summary'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
