<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            [
                'nombre' => 'Barranca',
                'ciudad_id' => '1',
            ],
            
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}
