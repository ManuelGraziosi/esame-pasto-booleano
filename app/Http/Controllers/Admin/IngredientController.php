<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Ingredient::query();

        // filtro per nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // filtro kcal min
        if ($request->filled('kcal_min')) {
            $query->where('energy_kcal', '>=', $request->kcal_min);
        }

        // filtro kcal max
        if ($request->filled('kcal_max')) {
            $query->where('energy_kcal', '<=', $request->kcal_max);
        }

        // paginazione dinamica
        $perPage = $request->input('per_page', 10);

        $ingredients = $query->paginate($perPage)->withQueryString();

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
