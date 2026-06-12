<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
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
}
