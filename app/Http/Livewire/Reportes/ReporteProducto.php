<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Producto;
use App\Models\Producto_venta;
use App\Models\Venta;
use COM;
use Livewire\Component;

class ReporteProducto extends Component
{

    public $fecha_inicio, $fecha_fin, $sucursal_id;
    

    public function render()
    {
        $cantidad = [];
        $produc = [];
        $ventas = Venta::whereBetween('fecha',[$this->fecha_inicio,$this->fecha_fin])->get();
        $productos = Producto::all();

            foreach($productos as $producto){
                $cantidad[$producto->id] = 0;
                foreach ($ventas as $venta){
                    $venta_producto = Producto_venta::where('venta_id',$venta->id)
                                                        ->where('producto_id',$producto->id)->first();                                  
                    if($venta_producto){
                        $cantidad[$producto->id] = $venta_producto->cantidad + $cantidad[$producto->id];
                    } 
                }
            }






        
        return view('livewire.reportes.reporte-producto',compact('cantidad','productos'));
    }
}
