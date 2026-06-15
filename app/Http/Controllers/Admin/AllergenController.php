<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allergen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allergens = Allergen::all();

        return view('allergens.index', compact('allergens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // return view('allergens.create');
        return view('allergens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // recupero tutti dati invati dal form
        $data = $request->all();
        // dd($data);
        $data['slug'] = Str::slug($request->name, '_');

        $newAllergen = new Allergen;

        $newAllergen->name = $data['name'];
        $newAllergen->slug = $data['slug'];
        $newAllergen->color = $data['color'];
        $newAllergen->text = $data['text'];
        $newAllergen->description = $data['description'];

        // controllo se c'è qualcosa in upload
        if (array_key_exists('icon', $data)) {

            // $newAllergen->icon = $data['icon'];
            $icon_path = Storage::putFile('allergens', $data['icon']);

            $newAllergen->icon = $icon_path;
        }

        // dd($newAllergen);

        $newAllergen->save();

        return redirect()->route('allergens.show', $newAllergen);
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergen $allergen)
    {

        return view('allergens.show', compact('allergen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allergen $allergen)
    {
        //
        return view('allergens.edit', compact('allergen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Allergen $allergen)
    {
        //
        // dd($request);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name, '_');

        $allergen->name = $data['name'];
        $allergen->slug = $data['slug'];
        $allergen->color = $data['color'];
        $allergen->text = $data['text'];
        $allergen->description = $data['description'];

        // rimozione immagine
        if ($request->has('remove_icon') && $allergen->icon) {

            Storage::delete($allergen->icon);

            $allergen->icon = null;
        }

        // upload nuova immagine
        if ($request->hasFile('icon')) {

            // cancella vecchia se esiste
            if ($allergen->icon) {
                Storage::delete($allergen->icon);
            }

            $path = Storage::putFile('allergens', $data['icon']);
            $allergen->icon = $path;
        }

        if (array_key_exists('icon', $data)) {

            // eliminare l'immagine precedente
            Storage::delete($allergen->icon);

            // caricare la nuova
            $icon_path = Storage::putFile('allergens', $data['icon']);

            // aggiornare il bb
            $allergen->icon = $icon_path;

        }
        // dd($allergen);

        $allergen->update();

        return view('allergens.show', compact('allergen'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergen $allergen)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $allergen->delete();

        return redirect()->route('allergens.index');
    }
}
