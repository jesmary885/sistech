<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ProductoExport implements FromView
{
 protected $array,$relacion,$sucursal;
    
     public function __construct($array,$relacion,$sucursal)
     {
         $this->array = $array;
         $this->relacion = $relacion;
         $this->sucursal = $sucursal;
     }

    public function view(): View
	{
        
		return view('exportexcel.productos', ['productos'=> $this->array,'relacion' => $this->relacion,'sucursal' => $this->sucursal]);
	}
}
