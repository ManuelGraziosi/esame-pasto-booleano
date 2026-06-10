<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    //
    public function ingredients()
    {
        return $this->belongsToMany((Ingredient::class))->withTimestamps();
    }
}
