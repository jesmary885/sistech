<?php

namespace Database\Seeders;

use App\Models\ProductoSerialSucursal;
use Illuminate\Database\Seeder;

class ProductoSerialSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos_sucursal_serials = [
            [
               'producto_id' => '1',
               'sucursal_id' => '1',
               'serial' => '111111',
               'cod_barra' => '656222',
               'compra_id' => '1',
               'fecha_compra' => date('Y-m-d'),
            ],
            [
                'producto_id' => '1',
                'sucursal_id' => '1',
                'serial' => '222222',
                'cod_barra' => '656222',
                'compra_id' => '1',
               'fecha_compra' => date('Y-m-d'),
             ],
             [
                'producto_id' => '1',
                'sucursal_id' => '2',
                'serial' => '333333',
                'cod_barra' => '656222',
                'compra_id' => '1',
               'fecha_compra' => date('Y-m-d'),
             ],
             [
                'producto_id' => '1',
                'sucursal_id' => '2',
                'serial' => '444444',
                'cod_barra' => '656222',
                'compra_id' => '1',
               'fecha_compra' => date('Y-m-d'),
             ],
             [
                 'producto_id' => '1',
                 'sucursal_id' => '3',
                 'serial' => '555555',
                 'cod_barra' => '656222',
                 'compra_id' => '1',
               'fecha_compra' => date('Y-m-d'),
              ],
              [
                 'producto_id' => '1',
                 'sucursal_id' => '3',
                 'serial' => '666666',
                 'cod_barra' => '656222',
                 'compra_id' => '1',
               'fecha_compra' => date('Y-m-d'),
              ],
             

            ];

             foreach ($productos_sucursal_serials as $producto){
                ProductoSerialSucursal::create($producto);
             }
    }
}
