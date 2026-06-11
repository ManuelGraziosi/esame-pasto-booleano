<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Manuel Admin',
            'email' => 'manuel.admin@example.com',
            'password' => '12345678',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Manuel User',
            'email' => 'manuel.user@example.com',
            'password' => '12345678',
        ]);

        $this->call([
            AllergensTableSeeder::class,
            IngredientsTableSeeder::class,
            AllergenIngredientTableSeeder::class,
            RecipesTableSeeder::class,
        ]);
    }
}
