<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ciudades = [
            [
                'nombre' => 'Lima',
                'pais_id' => '1',
            ],
            
        ];

        foreach ($ciudades as $ciudad) {
            Ciudad::create($ciudad);
        }
    }
}
