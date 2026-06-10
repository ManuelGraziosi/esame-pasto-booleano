<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

// use Faker\Generator as Faker;

class AllergensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergens = [

            [
                'slug' => 'cereali_con_glutine',
                'name' => 'Cereali contenenti glutine',
                'description' => 'Frumento, segale, orzo, avena, farro, kamut e loro derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/wheat.svg',
                'color' => '#D4A373',
                'text' => '#fff',
            ],

            [
                'slug' => 'crostacei',
                'name' => 'Crostacei',
                'description' => 'Gamberi, granchi, aragoste e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/bug.svg',
                'color' => '#E63946',
                'text' => '#fff',
            ],

            [
                'slug' => 'uova',
                'name' => 'Uova',
                'description' => 'Uova di gallina e altri volatili e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/egg.svg',
                'color' => '#F4E285',
                'text' => '#000',
            ],

            [
                'slug' => 'pesce',
                'name' => 'Pesce',
                'description' => 'Pesce e prodotti a base di pesce.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/water.svg',
                'color' => '#457B9D',
                'text' => '#fff',
            ],

            [
                'slug' => 'arachidi',
                'name' => 'Arachidi',
                'description' => 'Arachidi e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/circle.svg',
                'color' => '#8B5E3C',
                'text' => '#fff',
            ],

            [
                'slug' => 'soia',
                'name' => 'Soia',
                'description' => 'Soia e prodotti derivati (es. tofu, salsa di soia).',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/leaf.svg',
                'color' => '#6A994E',
                'text' => '#fff',
            ],

            [
                'slug' => 'latte',
                'name' => 'Latte',
                'description' => 'Latte e prodotti derivati (incluso lattosio).',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/cup-straw.svg',
                'color' => '#A8DADC',
                'text' => '#000',
            ],

            [
                'slug' => 'frutta_a_guscio',
                'name' => 'Frutta a guscio',
                'description' => 'Mandorle, nocciole, noci, pistacchi, anacardi, noci pecan, macadamia e loro derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/tree.svg',
                'color' => '#7F5539',
                'text' => '#fff',
            ],

            [
                'slug' => 'sedano',
                'name' => 'Sedano',
                'description' => 'Sedano e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/flower1.svg',
                'color' => '#70C1B3',
                'text' => '#fff',
            ],

            [
                'slug' => 'senape',
                'name' => 'Senape',
                'description' => 'Senape e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/triangle.svg',
                'color' => '#FFB703',
                'text' => '#fff',
            ],

            [
                'slug' => 'semi_di_sesamo',
                'name' => 'Semi di sesamo',
                'description' => 'Semi di sesamo e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/grid.svg',
                'color' => '#E9C46A',
                'text' => '#000',
            ],

            [
                'slug' => 'solfiti',
                'name' => 'Anidride solforosa e solfiti',
                'description' => 'Solfiti presenti in concentrazioni superiori a 10 mg/kg o 10 mg/l.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/exclamation-circle.svg',
                'color' => '#6C757D',
                'text' => '#fff',
            ],

            [
                'slug' => 'lupini',
                'name' => 'Lupini',
                'description' => 'Lupini e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/flower2.svg',
                'color' => '#90BE6D',
                'text' => '#fff',
            ],

            [
                'slug' => 'molluschi',
                'name' => 'Molluschi',
                'description' => 'Cozze, vongole, ostriche, calamari, polpo e prodotti derivati.',
                'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/water.svg',
                'color' => '#4D908E',
                'text' => '#fff',
            ],

        ];
        //

        Allergen::upsert(
            $allergens,
            ['slug'], // unique key
            ['name', 'description', 'icon']
        );

    }
}
