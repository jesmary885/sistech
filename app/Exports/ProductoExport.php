<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ProductoExport implements FromView
{
 protected $array,$relacion,$sucursal,$fecha_actual;
    
     public function __construct($array,$relacion,$sucursal)
     {
         $this->array = $array;
         $this->relacion = $relacion;
         $this->sucursal = $sucursal;
         $this->fecha_actual = date('d-m-Y');
     }

    public function view(): View
	{
        
		return view('exportexcel.productos', ['productos'=> $this->array,'relacion' => $this->relacion,'sucursal' => $this->sucursal,'fecha_actual' => $this->fecha_actual]);
	}
}
