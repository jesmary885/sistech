<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelos = [
            [
               'nombre' => 'J2 Prime',
               'marca_id' => '1',
            ],
            [
                'nombre' => 'X165(L Bello 2)',
                'marca_id' => '2',
             ],
             [
                'nombre' => 'Y3ii 3g',
                'marca_id' => '3',
             ],

            ];

             foreach ($modelos as $modelo){
                Modelo::create($modelo);
             }
    }
}
