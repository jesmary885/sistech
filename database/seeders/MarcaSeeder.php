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
               'nombre' => 'Otro',
            ],
           /* [
                'nombre' => 'LG',
             ],
             [
                'nombre' => 'HUA',
             ],
             [
               'nombre' => 'MOT',
            ],
            [
               'nombre' => 'ALC',
            ],
            [
               'nombre' => 'BIT',
            ],
            [
               'nombre' => 'ZTE',
            ],
            [
               'nombre' => 'BMB',
            ],
            [
               'nombre' => 'XIO',
            ],
            [
               'nombre' => 'VERY',
            ],
            [
               'nombre' => 'SON',
            ],
            [
               'nombre' => 'EKS',
            ],
            [
               'nombre' => 'IPH',
            ],
            [
               'nombre' => 'HTC',
            ],
            [
               'nombre' => 'AZUN',
            ],
            [
               'nombre' => 'LEN',
            ],
            [
               'nombre' => 'IPH',
            ],
            [
               'nombre' => 'S/M',
            ],
            [
               'nombre' => 'NOKIA',
            ],
            [
               'nombre' => 'IP',
            ],
            [
               'nombre' => 'GENERICO',
            ],
            [
               'nombre' => 'LENOVO',
            ],
            [
               'nombre' => 'HUW',
            ],*/

            ];

             foreach ($marcas as $marca){
                Marca::create($marca);
             }
    }
}
