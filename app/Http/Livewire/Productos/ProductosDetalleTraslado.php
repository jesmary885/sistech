<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento;
use App\Models\Sucursal;
use Livewire\Component;
use App\Models\Producto_sucursal as Pivot;

class ProductosDetalleTraslado extends Component
{

    public $isopen = false;
    public $sucursal, $cantidad, $sucursal_id = "", $sucursales, $producto;

    
 
      
    protected $rules = [
        'cantidad' => 'required',
        'sucursal_id' => 'required',
    ];

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(){
             $this->sucursales=Sucursal::where('id','!=',$this->sucursal)->get();
     }
    public function render()
    {
        return view('livewire.productos.productos-detalle-traslado');
    }

    public  function save()
    {
        $rules = $this->rules;
        $this->validate($rules);
        $fecha_actual = date('Y-m-d');
        $user_auth =  auth()->user()->id;

        $pivot_increment = Pivot::where('sucursal_id',$this->sucursal_id)->where('producto_id',$this->producto->id)->first();
        $pivot_decrement = Pivot::where('sucursal_id',$this->sucursal)->where('producto_id',$this->producto->id)->first(); 
        if($this->cantidad < $pivot_decrement->cantidad){
            $pivot_increment->cantidad = $pivot_increment->cantidad + $this->cantidad;
        $pivot_decrement->cantidad = $pivot_decrement->cantidad - $this->cantidad;

        $pivot_increment->save();
        $pivot_decrement->save();

        $sucursal_inicial = Sucursal::where('id',$this->sucursal)->first()->nombre;
        $sucursal_final = Sucursal::where('id',$this->sucursal_id)->first()->nombre;

        $movimiento = new Movimiento();
            $movimiento->fecha = $fecha_actual;
            $movimiento->tipo_movimiento = 'Traslado';
            $movimiento->cantidad = $this->cantidad;
            $movimiento->precio = $this->producto->precio_letal;
            $movimiento->observacion = 'Traslado desde almacen '. $sucursal_inicial .' hasta almacen '. $sucursal_final;
            $movimiento->producto_id = $this->producto->id;
            $movimiento->user_id = $user_auth;
            $movimiento->save();

            $this->reset(['isopen','sucursal_id','cantidad']);
            $this->emitTo('productos.productos-traslado','render');
            $this->emit('alert','Datos registrados correctamente');
        } else{
            $this->emit('errorSize','La cantidad ingresada supera la disponible en inventario');
        }
        
    }
}
