<?php

namespace Database\Seeders;

use App\Models\impresora;
use Illuminate\Database\Seeder;

class ImpresoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $impresoras = [
            [
               'nombre' => 'TECHI1',
            ],
            [
                'nombre' => 'TECHI2',
             ],
      

            ];

             foreach ($impresoras as $impresora){
                impresora::create($impresora);
             }
    }
}
