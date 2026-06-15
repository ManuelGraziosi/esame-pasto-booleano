<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Recipe extends Model
{
    //

    protected $appends = ['allergens'];

    public function ingredients()
    {
        return $this->belongsToMany((Ingredient::class))->withTimestamps()->withPivot('quantity');
    }

    public function getAllergensAttribute()
    {
        return Allergen::whereHas('ingredients.recipes', function ($q) {
            $q->where('recipes.id', $this->id);
        })->distinct()->get();
    }

    public function getTotalKcalAttribute()
    {
        return $this->ingredients->sum(function ($ingredient) {
            return ($ingredient->energy_kcal * $ingredient->pivot->quantity) / 100;
        });
    }

    // // funzione per erogare correttamente l'url valido delle immagini (adattivo tramite campi .env)
    // protected function image(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value ? Storage::url($value) : null,
    //     );
    // }
}
