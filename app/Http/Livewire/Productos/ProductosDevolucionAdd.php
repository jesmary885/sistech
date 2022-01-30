<?php

namespace App\Http\Livewire\Productos;

use App\Models\Devolucion;
use App\Models\Movimiento;
use App\Models\Producto_venta;
use App\Models\Venta;
use Livewire\Component;

class ProductosDevolucionAdd extends Component
{
    public $isopen = false;
    public $cantidad,$observaciones,$nro_factura;
    public $producto_id = "";
    public $productos = [];
    public $factura = 1;

    protected $rules = [
        'producto_id' => 'required',
        'observaciones' => 'required'
    ];

    public function render()
    {
        return view('livewire.productos.productos-devolucion-add');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function buscar($nro_factura){
        $this->factura = 0;
        $this->productos = Producto_venta::where('venta_id',$this->nro_factura)->get();
    }

    public function save(){
        $rules = $this->rules;
        $this->validate($rules);
        $user_auth = auth()->user()->id;
        $fecha_actual = date('Y-m-d');

        $producto = Producto_venta::where('producto_id',$this->producto_id)->first();

        $devolucion = new Devolucion();
        $devolucion->fecha = $fecha_actual;
        $devolucion->user_id = $user_auth;
        $devolucion->venta_id = $this->nro_factura;
        $devolucion->producto_id = $this->producto_id;
        $devolucion->cantidad = '1';
        $devolucion->observaciones = $this->observaciones;
        $devolucion->save();

        $movimiento = new Movimiento();
        $movimiento->fecha = $fecha_actual;
        $movimiento->tipo_movimiento = 'Devolución de producto';
        $movimiento->cantidad = '1';
        $movimiento->precio = $producto->precio;
        $movimiento->observacion = $this->observaciones;
        $movimiento->producto_id = $this->producto_id;
        $movimiento->user_id = $user_auth;
        $movimiento->save();

        // $venta= Venta::where('id',$this->venta_id)->first();
        // $nueva_subtotal_venta = $venta->subtotal - ($producto_venta->precio);
        // $venta->update([
        //     'subtotal' => $nueva_subtotal_venta
        // ]);

//         $producto_venta = Producto_venta::where('venta_id',$this->venta_id)
//         ->where('producto_id',$this->producto_id)->first();
// $cantidad_nueva_producto_venta = $producto_venta->cantidad - 1;
// $producto_venta->update([
// 'cantidad' => $cantidad_nueva_producto_venta
// ]);
        
        $this->reset(['factura','nro_factura','producto_id','cantidad','observaciones','isopen']);
        $this->emitTo('productos.productos-devolucion','render');
        $this->emit('alert','Datos registrados correctamente');
    }
}
