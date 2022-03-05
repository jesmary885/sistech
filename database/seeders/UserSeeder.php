<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
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
            'name' => 'Admin',
            'apellido' => 'Admin',
            'email' => 'admin@tech.com',
            'password' => bcrypt('12345678'),
            'password_cifrada' => Crypt::encryptString('12345678'),
            'telefono' => '5196448027',
            'direccion' => 'Perú',
            'tipo_documento' => '3',
            'nro_documento' => '17591985',
            'ciudad_id' => '1',
            'estado_id' => '1',
            'estado' => '1',
            'limitacion' => '1',
            'sucursal_id' => '1',
        ])->assignRole('Administrador');
        
    }
}
