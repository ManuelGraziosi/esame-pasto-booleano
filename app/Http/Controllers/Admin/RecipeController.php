<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $recipes = Recipe::all();

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ingredients = Ingredient::all();

        return view('recipes.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        // dd($data);

        $newRecipe = new Recipe;
        $newRecipe->title = $data['title'];
        $newRecipe->image = $data['image'];
        $newRecipe->description = $data['description'];
        $newRecipe->preparation = $data['preparation'];

        // dd($newRecipe);

        $newRecipe->save();

        // aggiungere sync degli ingredient
        // dd($data['ingredients']);
        $syncData = [];

        foreach ($data['ingredients'] as $item) {
            $syncData[$item['id']] = ['quantity' => $item['quantity']];
        }

        // dd($syncData);

        $newRecipe->ingredients()->sync($syncData);

        return redirect()->route('recipes.show', $newRecipe);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
        $recipe->load('ingredients'); // per popolare l'elenco delgi ingredienti
        $ingredients = Ingredient::all();

        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //

        $data = $request->all();

        $recipe->title = $data['title'];
        $recipe->image = $data['image'];
        $recipe->description = $data['description'];
        $recipe->preparation = $data['preparation'];

        $recipe->update();

        $syncData = [];

        foreach ($data['ingredients'] as $item) {
            $syncData[$item['id']] = ['quantity' => $item['quantity']];
        }

        $recipe->ingredients()->sync($syncData);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $recipe->ingredients()->detach();

        $recipe->delete();

        return redirect()->route('recipes.index');
    }
}
