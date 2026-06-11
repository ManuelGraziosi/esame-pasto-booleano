<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allergen;
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
        $allergens = Allergen::all();
        $query = Ingredient::query();

        // INCLUDE (almeno uno)
        if ($request->filled('allergens_include')) {
            $query->whereHas('allergens', function ($q) use ($request) {
                $q->whereIn('allergens.id', $request->allergens_include);
            });
        }

        // EXCLUDE
        if ($request->filled('allergens_exclude')) {
            $query->whereDoesntHave('allergens', function ($q) use ($request) {
                $q->whereIn('allergens.id', $request->allergens_exclude);
            });
        }

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

        return view('ingredients.index', compact('ingredients', 'allergens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ingredients.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $newIngredient = new Ingredient;
        $newIngredient->name = $data['name'];
        $newIngredient->slug = $data['slug'];
        $newIngredient->energy_kcal = $data['energy_kcal'];
        $newIngredient->proteins = $data['proteins'];
        $newIngredient->lipids = $data['lipids'];
        $newIngredient->available_carbohydrates = $data['available_carbohydrates'];
        $newIngredient->total_fiber = $data['total_fiber'];
        $newIngredient->iron = $data['iron'];
        $newIngredient->sodium = $data['sodium'];
        $newIngredient->calcium = $data['calcium'];
        $newIngredient->potassium = $data['potassium'];

        // dd($newIngredient);

        $newIngredient->save();

        return redirect()->route('ingredients.show', $newIngredient);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //

        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        //
        $allergens = Allergen::all();

        return view('ingredients.edit', compact('ingredient', 'allergens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //
        $data = $request->all();

        // dd($data);

        $ingredient->name = $data['name'];
        $ingredient->slug = $data['slug'];
        $ingredient->energy_kcal = $data['energy_kcal'];
        $ingredient->proteins = $data['proteins'];
        $ingredient->lipids = $data['lipids'];
        $ingredient->available_carbohydrates = $data['available_carbohydrates'];
        $ingredient->total_fiber = $data['total_fiber'];
        $ingredient->iron = $data['iron'];
        $ingredient->sodium = $data['sodium'];
        $ingredient->calcium = $data['calcium'];
        $ingredient->potassium = $data['potassium'];

        $ingredient->update();

        // sincroniziamo gli allergeni nella pivot
        $ingredient->allergens()->sync($data['allergens']);

        return view('ingredients.show', compact('ingredient'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $ingredient->delete();

        return redirect()->route('ingredients.index');
    }
}
