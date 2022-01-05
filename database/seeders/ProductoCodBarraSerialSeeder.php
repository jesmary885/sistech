<?php

namespace Database\Seeders;

use App\Models\Producto_cod_barra_serial;
use Illuminate\Database\Seeder;

class ProductoCodBarraSerialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $productos = [
            [
               'serial' => '12345678',
               'producto_id' => '1',
               'sucursal_id' => '1'
            ],
            [
                'serial' => '12345679',
                'producto_id' => '1', 
                'sucursal_id' => '1'
             ],
             [
                'serial' => '123456710',
                'producto_id' => '1', 
                'sucursal_id' => '2'
             ],
             [
                'serial' => '123456711',
                'producto_id' => '1',
                'sucursal_id' => '2'
             ],
             [
                'serial' => '123456712',
                'producto_id' => '1', 
                'sucursal_id' => '3'
             ],
             [
                'serial' => '12345678',
                'producto_id' => '1',
                'sucursal_id' => '3'
             ],

            ];

             foreach ($productos as $producto){
                Producto_cod_barra_serial::create($producto);
             }
     
    }
}
