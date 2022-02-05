<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Producto;
use App\Models\Producto_venta;
use App\Models\Venta;
use COM;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteProducto extends Component
{

    public $fecha_inicio, $fecha_fin, $sucursal_id;
    
    public function render()
    {
        $fecha_inicioo = date("Y-m-d",strtotime($this->fecha_inicio));
        $fecha_finn = date("Y-m-d",strtotime($this->fecha_fin));
        $sucursal = $this->sucursal_id;

        if($sucursal == 0){
            $productos = DB::select('SELECT p.cod_barra, p.nombre, p.id, sum(dv.cantidad) as quantity from productos p
            inner join producto_ventas dv on p.id=dv.producto_id
            inner join ventas v on dv.venta_id = v.id where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn
            group by p.cod_barra, p.nombre, p.id order by sum(dv.cantidad) desc limit 5',array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
        } else{
            $productos = DB::select('SELECT p.cod_barra, p.nombre, p.id, sum(dv.cantidad) as quantity from productos p
            inner join producto_ventas dv on p.id=dv.producto_id 
            inner join ventas v on dv.venta_id = v.id where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn and :sucursal = v.sucursal_id
            group by p.cod_barra, p.nombre, p.id order by sum(dv.cantidad) desc limit 5',array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn, 'sucursal' => $sucursal));
        }

        $data=json_encode($productos);
        $array = json_decode($data, true);

        foreach($array as $arrays){
            $puntos[]=['name' => $arrays['nombre'] , 'y' => $arrays['quantity']];
            $data2 = json_encode($puntos);
        }
        return view('livewire.reportes.reporte-producto',compact('array','data2'));
    }
}
