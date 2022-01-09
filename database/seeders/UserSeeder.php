<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jesmary Carneiro',
            'email' => 'jesmary885@gmail.com',
            'password' => bcrypt('12345678'),
            'telefono' => '04152668777',
            'direccion' => 'Avenida francisco de miranda calle 84',
            'tipo_documento' => 'ci',
            'nro_documento' => '17591985',
            'ciudad_id' => '1',
            'estado_id' => '1',
            'estado' => '1',
            'limitacion' => '1',
            'sucursal_id' => '1',
        ])->assignRole('Admin');
        
    }
}
