<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    //
    public function index()
    {
        // prendo tutti gli ingredienti dal DB
        $ingredients = Ingredient::with('allergens')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Ingredients retrieved successfully',
            'data' => $ingredients->items(),
            'meta' => [
                'current_page' => $ingredients->currentPage(),
                'last_page' => $ingredients->lastPage(),
                'per_page' => $ingredients->perPage(),
                'total' => $ingredients->total(),
            ],
        ]);
    }

    public function show(Ingredient $ingredient)
    {
        $ingredient->load('allergens');

        return response()->json([
            'success' => true,
            'data' => $ingredient,
        ],
        );
    }

    public function store() {}

    public function update() {}

    public function modify() {}

    public function destroy() {}
}
