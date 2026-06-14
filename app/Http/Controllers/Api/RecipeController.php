<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;

class RecipeController extends Controller
{
    //
    public function index()
    {
        // prendo tutti gli recipei dal DB
        $recipes = Recipe::paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Recipes retrieved successfully',
            'data' => $recipes->items(),
            'meta' => [
                'current_page' => $recipes->currentPage(),
                'last_page' => $recipes->lastPage(),
                'per_page' => $recipes->perPage(),
                'total' => $recipes->total(),
            ],
        ]);
    }

    public function show(Recipe $recipe)
    {

        $recipe->load('ingredients');

        $recipe->allergens;

        return response()->json([
            'success' => true,
            'data' => $recipe,
        ],
        );
    }

    public function store() {}

    public function update() {}

    public function modify() {}

    public function destroy() {}
}
