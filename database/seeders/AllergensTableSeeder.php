<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/wheat.svg'
    ],

    [
        'slug' => 'crostacei',
        'name' => 'Crostacei',
        'description' => 'Gamberi, granchi, aragoste e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/bug.svg'
    ],

    [
        'slug' => 'uova',
        'name' => 'Uova',
        'description' => 'Uova di gallina e altri volatili e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/egg.svg'
    ],

    [
        'slug' => 'pesce',
        'name' => 'Pesce',
        'description' => 'Pesce e prodotti a base di pesce.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/water.svg'
    ],

    [
        'slug' => 'arachidi',
        'name' => 'Arachidi',
        'description' => 'Arachidi e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/circle.svg'
    ],

    [
        'slug' => 'soia',
        'name' => 'Soia',
        'description' => 'Soia e prodotti derivati (es. tofu, salsa di soia).',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/leaf.svg'
    ],

    [
        'slug' => 'latte',
        'name' => 'Latte',
        'description' => 'Latte e prodotti derivati (incluso lattosio).',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/cup-straw.svg'
    ],

    [
        'slug' => 'frutta_a_guscio',
        'name' => 'Frutta a guscio',
        'description' => 'Mandorle, nocciole, noci, pistacchi, anacardi, noci pecan, macadamia e loro derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/tree.svg'
    ],

    [
        'slug' => 'sedano',
        'name' => 'Sedano',
        'description' => 'Sedano e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/flower1.svg'
    ],

    [
        'slug' => 'senape',
        'name' => 'Senape',
        'description' => 'Senape e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/triangle.svg'
    ],

    [
        'slug' => 'semi_di_sesamo',
        'name' => 'Semi di sesamo',
        'description' => 'Semi di sesamo e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/grid.svg'
    ],

    [
        'slug' => 'solfiti',
        'name' => 'Anidride solforosa e solfiti',
        'description' => 'Solfiti presenti in concentrazioni superiori a 10 mg/kg o 10 mg/l.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/exclamation-circle.svg'
    ],

    [
        'slug' => 'lupini',
        'name' => 'Lupini',
        'description' => 'Lupini e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/flower2.svg'
    ],

    [
        'slug' => 'molluschi',
        'name' => 'Molluschi',
        'description' => 'Cozze, vongole, ostriche, calamari, polpo e prodotti derivati.',
        'icon' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/icons/water.svg'
    ]

];
        //

        Allergen::upsert(
            $allergens,
            ['slug'], // unique key
            ['name', 'description', 'icon']
        );

    }
}
