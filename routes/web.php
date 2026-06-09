<?php

use App\Http\Controllers\Admin\AllergenController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/laravel-home', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/allergens', AllergenController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/ingredients', IngredientController::class)
        ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
