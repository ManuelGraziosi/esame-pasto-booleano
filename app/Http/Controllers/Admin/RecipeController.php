<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        // $recipes = Recipe::all();
        $allergens = Allergen::all();

        $query = Recipe::query();

        // ricerca nel titolo
        if ($request->filled('search_title')) {
            $query->where('title', 'like', '%'.$request->search_title.'%');
        }

        // ricerca nella descrizione
        if ($request->filled('search_description')) {
            $query->where('description', 'like', '%'.$request->search_description.'%');
        }

        // include almeno un allergene
        if ($request->filled('allergens_include')) {
            $query->whereHas('ingredients.allergens', function ($q) use ($request) {
                $q->whereIn('allergens.id', $request->allergens_include);
            });
        }

        // esclude allergeni
        if ($request->filled('allergens_exclude')) {
            $query->whereDoesntHave('ingredients.allergens', function ($q) use ($request) {
                $q->whereIn('allergens.id', $request->allergens_exclude);
            });
        }

        // paginazione dinamica
        $perPage = $request->input('per_page', 10);

        $recipes = $query->paginate($perPage)->withQueryString();

        return view('recipes.index', compact('recipes', 'allergens'));
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

        // upload nuova immagine
        if ($request->hasFile('image')) {

            $path = Storage::putFile('recipes', $data['image']);
            $newRecipe->image = $path;
        }

        $newRecipe->description = $data['description'];
        $newRecipe->preparation = $data['preparation'];

        // dd($data);
        // controllo se c'è qualcosa in upload
        if (array_key_exists('image', $data)) {

            $image_path = Storage::putFile('recipes', $data['image']);

            $newRecipe->image = $image_path;
        }

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
        // dd($data);
        $recipe->title = $data['title'];

        // rimozione immagine
        if ($request->has('remove_image') && $recipe->image) {

            Storage::delete($recipe->image);

            $recipe->image = null;
        }

        // upload nuova immagine
        if ($request->hasFile('image')) {

            // cancella vecchia se esiste
            if ($recipe->image) {
                Storage::delete($recipe->image);
            }

            $path = Storage::putFile('recipes', $data['image']);
            $recipe->image = $path;
        }

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
