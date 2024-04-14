<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'is_banned'])->name('dashboard');

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// Admin routes
// Route::middleware(['auth', 'is_admin'])->group(function () {
//     Route::get('/users', [AdminController::class, 'index'])->name('admin.show.users');
// });

Route::get('/users', [AdminController::class, 'index'])
    ->name('admin.show.users')
    ->middleware(['auth', 'is_admin']);

Route::put('/users/{user}/block', [AdminController::class, 'block'])
    ->name('users.block')
    ->middleware(['auth', 'is_admin']);

Route::put('/users/{user}/unblock', [AdminController::class, 'unblock'])
    ->name('users.unblock')
    ->middleware(['auth', 'is_admin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
