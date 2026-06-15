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
                'icon' => 'allergens/tpkhmkf247jMhAwaaquy9PTQFqqc0QxtGjgtlqzw.png',
                'color' => '#D4A373',
                'text' => '#fff',
            ],

            [
                'slug' => 'crostacei',
                'name' => 'Crostacei',
                'description' => 'Gamberi, granchi, aragoste e prodotti derivati.',
                'icon' => 'allergens/YU2PLyuc2vVEBr4tW3HLdWIKWP9mfaW40xXqI4Rt.png',
                'color' => '#E63946',
                'text' => '#fff',
            ],

            [
                'slug' => 'uova',
                'name' => 'Uova',
                'description' => 'Uova di gallina e altri volatili e prodotti derivati.',
                'icon' => 'allergens/gS2w6qUjm0Iy7jeYgKth5l4JqBDOC9yOHyRwYZ4R.png',
                'color' => '#F4E285',
                'text' => '#000',
            ],

            [
                'slug' => 'pesce',
                'name' => 'Pesce',
                'description' => 'Pesce e prodotti a base di pesce.',
                'icon' => 'allergens/qmL8W4MQdT1MqQPT9mRag4s8yUHy0nEFvnezIlxN.png',
                'color' => '#457B9D',
                'text' => '#fff',
            ],

            [
                'slug' => 'arachidi',
                'name' => 'Arachidi',
                'description' => 'Arachidi e prodotti derivati.',
                'icon' => 'allergens/oReuu1kN1mlqpScy9qkH6LdEysYxYmqFSHg8KIA6.png',
                'color' => '#8B5E3C',
                'text' => '#fff',
            ],

            [
                'slug' => 'soia',
                'name' => 'Soia',
                'description' => 'Soia e prodotti derivati (es. tofu, salsa di soia).',
                'icon' => 'allergens/1rG3tllBTVLZRPkDNmRqS2ClhAgdt3nCuhYbrJlv.png',
                'color' => '#6A994E',
                'text' => '#fff',
            ],

            [
                'slug' => 'latte',
                'name' => 'Latte',
                'description' => 'Latte e prodotti derivati (incluso lattosio).',
                'icon' => 'allergens/E7IF4dcKxJe0tt27rsJoRPgLMcbdJwzM5gnsCktQ.png',
                'color' => '#A8DADC',
                'text' => '#000',
            ],

            [
                'slug' => 'frutta_a_guscio',
                'name' => 'Frutta a guscio',
                'description' => 'Mandorle, nocciole, noci, pistacchi, anacardi, noci pecan, macadamia e loro derivati.',
                'icon' => 'allergens/eNThxlMAvmRBRWO9maEXnGDj2PyFtImpHz3GDaAD.png',
                'color' => '#7F5539',
                'text' => '#fff',
            ],

            [
                'slug' => 'sedano',
                'name' => 'Sedano',
                'description' => 'Sedano e prodotti derivati.',
                'icon' => 'allergens/pAyakxpResKDWSrNrRaz1veUBbfAWLUZDwj0QWjM.png',
                'color' => '#70C1B3',
                'text' => '#fff',
            ],

            [
                'slug' => 'senape',
                'name' => 'Senape',
                'description' => 'Senape e prodotti derivati.',
                'icon' => 'allergens/KlysiUofJ195z4SrIy8GSAj5mQoMPCyoQBp6lCh7.png',
                'color' => '#FFB703',
                'text' => '#fff',
            ],

            [
                'slug' => 'semi_di_sesamo',
                'name' => 'Semi di sesamo',
                'description' => 'Semi di sesamo e prodotti derivati.',
                'icon' => 'allergens/dG6N6ghGFRSNAQr3f1hHVhYdwclaAEvbcJU1OZMz.png',
                'color' => '#E9C46A',
                'text' => '#000',
            ],

            [
                'slug' => 'solfiti',
                'name' => 'Anidride solforosa e solfiti',
                'description' => 'Solfiti presenti in concentrazioni superiori a 10 mg/kg o 10 mg/l.',
                'icon' => 'allergens/3kxsE5BicG1Hxeew688pJAsZS9mJMqfaffHc7L7J.png',
                'color' => '#6C757D',
                'text' => '#fff',
            ],

            [
                'slug' => 'lupini',
                'name' => 'Lupini',
                'description' => 'Lupini e prodotti derivati.',
                'icon' => 'allergens/BaEHj2x9HIB87D6PJiqBrdoHx6FhLs0oFMICe5mt.png',
                'color' => '#90BE6D',
                'text' => '#fff',
            ],

            [
                'slug' => 'molluschi',
                'name' => 'Molluschi',
                'description' => 'Cozze, vongole, ostriche, calamari, polpo e prodotti derivati.',
                'icon' => 'allergens/eDF86xKeyORokaxczlfjlgFjHcLkaiuHb3o988uW.png',
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
