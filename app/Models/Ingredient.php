<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //
    public function allergens()
    {
        return $this->belongsToMany((Allergen::class))->withTimestamps();
    }

    public function recipes()
    {
        return $this->belongsToMany((Recipe::class))->withTimestamps();
    }
}
