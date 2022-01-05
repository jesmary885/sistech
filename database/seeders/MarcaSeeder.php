<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = [
            [
               'nombre' => 'SAM',
            ],
            [
                'nombre' => 'LG',
             ],
             [
                'nombre' => 'HUA',
             ],

            ];

             foreach ($marcas as $marca){
                Marca::create($marca);
             }
    }
}
