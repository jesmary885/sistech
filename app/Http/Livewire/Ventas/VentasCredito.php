<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto_venta;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class VentasCredito extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $productos,$collection = [];


    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

   
    public function render()
    {
    

        $ventas = Venta::where('fecha', 'LIKE', '%' . $this->search . '%')
                        // ->orwhereHas('cliente',function(Builder $query){
                        // $query->where('nro_documento','LIKE', '%' . $this->search . '%');})
                     ->where('tipo_pago', 2)
                        ->latest('id')
                        ->paginate(5);
        return view('livewire.ventas.ventas-credito',compact('ventas'));
    }

    // public function factura($venta_id){

    //     $venta_select = Venta::where('id',$venta_id)->first();
    //     $this->productos = Producto_venta::where('venta_id',$venta_id)->get();
    //     $productos = $this->productos;
    //      $collection = [];

    //      foreach ($productos as $producto){
    //          $collection = ['name' => $producto->nombre,
    //                          'price' => $producto->precio_letal,
    //                          ];
    //      }

         

    //     // $data = [
    //     //     'cliente_nombre' => $venta_select->cliente_id->nombre." ".$venta_select->cliente_id->apellido,
    //     //     'cliente_documento' =>$venta_select->cliente_id->nro_documento,
    //     //     'cliente_telefono' =>$venta_select->cliente_id->telefono,
    //     //     'usuario' => auth()->user()->name." ".auth()->user()->apellido,
    //     //     'fecha_actual' => $venta_select->fecha,
    //     //     'venta_nro' => $venta_select->id,
    //     //     'collection' => $collection,
    //     //     'estado_entrega' => $venta_select->estado_entrega,
    //     //     'descuento' => $venta_select->descuento,
    //     //     'pagado' => $venta_select->total_pagado_cliente,
    //     //     'deuda' => $venta_select->deuda_cliente,
    //     //     'subtotal' => $venta_select->subtotal
    //     // ];

    //     // $pdf = PDF::loadView('ventas.FacturaCredito',$data)->output();
    //     // return response()->streamDownload(
    //     //     fn () => print($pdf),
    //     //    "filename.pdf"
    //     //     );

    //         return view('livewire.ventas.ventas-credito',compact('collection'));
    // }
}
