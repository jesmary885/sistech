<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteVenta extends Component
{
    public $fecha_inicio, $fecha_fin, $sucursal_id;
    
    public function render()
    {
        $ano=date("Y");
        $fecha_inicioo = date("Y-m-d",strtotime($this->fecha_inicio));
        $fecha_finn = date("Y-m-d",strtotime($this->fecha_fin));
        $sucursal = $this->sucursal_id;
        $sucursales = Sucursal::all();
        $i = 1;
        $data2 = 0;

        if($sucursal == 0){
            $cantidad_ventas = DB::select('SELECT COUNT(*) as cantidad from ventas V 
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));

            $total_ventas = DB::select('SELECT sum(v.total_pagado_cliente) as quantity from ventas v
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));

            $costo_ventas = DB::select('SELECT sum(c.total) as quantity from compras c
             where c.fecha BETWEEN :fecha_inicioo AND :fecha_finn'
             ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
    

            $total_ventas_sucursal_1=DB::select('SELECT sum(v.total_pagado_cliente) as quantity from ventas v
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn and v.sucursal_id = "1"'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
            $total_ventas_sucursal_11 = json_encode($total_ventas_sucursal_1);
            $total_ventas_sucursal_111 = json_decode($total_ventas_sucursal_11);

            $total_ventas_sucursal_2=DB::select('SELECT sum(v.total_pagado_cliente) as quantity from ventas v
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn and v.sucursal_id = "2"'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
            $total_ventas_sucursal_22 = json_encode($total_ventas_sucursal_2);
            $total_ventas_sucursal_222 = json_decode($total_ventas_sucursal_22);

            $total_ventas_sucursal_3=DB::select('SELECT sum(v.total_pagado_cliente) as quantity from ventas v
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn and v.sucursal_id = "3"'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
            $total_ventas_sucursal_33 = json_encode($total_ventas_sucursal_3);
            $total_ventas_sucursal_333 = json_decode($total_ventas_sucursal_33);

           foreach($sucursales as $sucursal){
               if($sucursal->id==1)$t_v=$total_ventas_sucursal_111[0]->quantity;
               elseif($sucursal->id==2)$t_v=$total_ventas_sucursal_222[0]->quantity;
               else $t_v=$total_ventas_sucursal_333[0]->quantity;
                $puntos[]=['name' => $sucursal->nombre, 'y' => $t_v];
                $data2 = json_encode($puntos);
            }

        }else{
            $cantidad_ventas = DB::select('SELECT COUNT(*) as cantidad from ventas V 
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn and :sucursal = v.sucursal_id'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn, 'sucursal' => $sucursal));

            $total_ventas = DB::select('SELECT sum(v.total_pagado_cliente) as quantity from ventas v
            where v.fecha BETWEEN :fecha_inicioo AND :fecha_finn and :sucursal = v.sucursal_id'
            ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn, 'sucursal' => $sucursal));

            $costo_ventas = DB::select('SELECT sum(c.total) as quantity from compras c
             where c.fecha BETWEEN :fecha_inicioo AND :fecha_finn'
             ,array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
        }

        

        $cantidad_vent=json_encode($cantidad_ventas);
        $cantidad_venta=json_decode($cantidad_vent);
   
        $total_vent=json_encode($total_ventas);
        $total_venta=json_decode($total_vent);
        
        $costo_vent=json_encode($costo_ventas);
        $costo_venta=json_decode($costo_vent);
            

      

        return view('livewire.reportes.reporte-venta',compact('cantidad_venta','total_venta','costo_venta','data2'));
    }
}
