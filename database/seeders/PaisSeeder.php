<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paises = [
            [
                'nombre' => 'Peru',
            ],
            
        ];

        foreach ($paises as $pais) {
            Pais::create($pais);
        }
    }
}
