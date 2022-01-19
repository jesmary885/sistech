<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('productos');
        Storage::makeDirectory('productos');
        $this->call(PaisSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ModeloSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ProductoCodBarraSerialSeeder::class);
        $this->call(ProductoSucursalSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(EmpresaSeeder::class);
    }
}
