<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'nombre' => 'Pablo',
            'apellido' => 'Perez',
            'email' => 'pablo@gmail.com',
            'nro_documento' => '12345678',
            'tipo_documento' => '1',
            'telefono' => '04152668777',
            'direccion' => 'Avenida francisco de miranda calle 84',
            'pais_id' => '1',
            'ciudad_id' => '1',
            'estado_id' => '1',
        ]);
        
    }
}

