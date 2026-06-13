<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Allergen;

class AllergenController extends Controller
{
    //
    public function index()
    {
        // prendo tutti gli allergeni dal DB
        $allergens = Allergen::paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Allergens retrieved successfully',
            'data' => $allergens->items(),
            'meta' => [
                'current_page' => $allergens->currentPage(),
                'last_page' => $allergens->lastPage(),
                'per_page' => $allergens->perPage(),
                'total' => $allergens->total(),
            ],
        ]);
    }

    public function show(Allergen $allergen)
    {
        $allergen->load('ingredients');

        return response()->json([
            'success' => true,
            'data' => $allergen,
        ],
        );
    }

    public function store() {}

    public function update() {}

    public function modify() {}

    public function destroy() {}
}
