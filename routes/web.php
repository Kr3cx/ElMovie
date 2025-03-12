<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Main page
Route::get('/', function () {
    return view('welcome');
});

// Genre Routes (Without Middleware for now)
Route::get('genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('genres/create', [GenreController::class, 'create'])->name('genres.create'); 
Route::get('genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

Route::middleware('auth')->group(function () {
    Route::post('genres', [GenreController::class, 'store'])->name('genres.store');
    Route::get('genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');
});

// Film Routes (Without Middleware for now)
Route::get('films', [FilmController::class, 'index'])->name('films.index');
Route::get('films/create', [FilmController::class, 'create'])->name('films.create'); 
Route::get('films/{film}', [FilmController::class, 'show'])->name('films.show');

Route::middleware('auth')->group(function () {
    Route::post('films', [FilmController::class, 'store'])->name('films.store');
    Route::get('films/{film}/edit', [FilmController::class, 'edit'])->name('films.edit');
    Route::put('films/{film}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');

    // Review Routes
    Route::post('/films/{film}/ulasans', [UlasanController::class, 'store'])->name('ulasans.store');
    Route::get('ulasans/{ulasan}/edit', [UlasanController::class, 'edit'])->name('ulasans.edit');
    Route::put('ulasans/{ulasan}', [UlasanController::class, 'update'])->name('ulasans.update');
    Route::delete('ulasans/{ulasan}', [UlasanController::class, 'destroy'])->name('ulasans.destroy');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Auth Routes
Auth::routes();