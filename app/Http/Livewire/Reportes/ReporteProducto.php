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
        /*$cantidad = [];
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
            }*/

             /*$productos = DB::select('SELECT p.cod_barra, p.nombre, p.id, sum(dv.cantidad) as quantity from productos p
             inner join producto_ventas dv on p.id=dv.producto_id
             inner join ventas v on dv.venta_id = v.id where year(v.fecha)=year(curdate())
             group by p.cod_barra, p.nombre, p.id order by sum(dv.cantidad) desc limit 5');*/

             $fecha_inicio = $this->fecha_inicio;
             $fecha_fin = $this->fecha_fin;

             $productos = DB::select('SELECT p.cod_barra, p.nombre, p.id, sum(dv.cantidad) as quantity from productos p
             inner join producto_ventas dv on p.id=dv.producto_id
             inner join ventas v on dv.venta_id = v.id where v.fecha BETWEEN "2022-02-01" AND "2022-02-03"
             group by p.cod_barra, p.nombre, p.id order by sum(dv.cantidad) desc limit 5');


            $data=json_encode($productos);
            $array = json_decode($data, true);

            foreach($array as $arrays){
                $puntos[]=['name' => $arrays['nombre'] , 'y' => $arrays['quantity']];
                $data2 = json_encode($puntos);
            }


        //  foreach($array as $value){
        //      $hola = "esto es asi " . $value['nombre']. "hola";
        //      print ($hola);
        //  }
        
        return view('livewire.reportes.reporte-producto',compact('array','data2'));
    }
}
