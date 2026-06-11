<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //
        for ($i = 0; $i < 10; $i++) {

            $newRecipe = new Recipe;

            $newRecipe->title = "Ricetta $i";
            $newRecipe->image = 'https://picsum.photos/200/300';
            $newRecipe->description = $faker->paragraph(4);
            $newRecipe->preparation = $faker->paragraph(8);

            $newRecipe->save();
        }
    }
}
