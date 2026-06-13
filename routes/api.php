<?php

use App\Http\Controllers\Api\AllergenController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('allergens', [AllergenController::class, 'index']);

Route::get('allergens/{allergen}', [AllergenController::class, 'show']);

Route::get('ingredients', [IngredientController::class, 'index']);

Route::get('ingredients/{ingredient}', [IngredientController::class, 'show']);

Route::get('recipes', [RecipeController::class, 'index']);

Route::get('recipes/{recipe}', [RecipeController::class, 'show']);
