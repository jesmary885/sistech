<?php

namespace App\Http\Livewire\Ventas;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto_sucursal as Pivot;

use Livewire\Component;

class VentasSeleccionCantidades extends Component
{

    public $isopen = false;
    public $producto, $sucursal, $precios;
    public $qty = 1;

    public $options = [
        'puntos' => null,
    ];

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function mount(){

        $this->cantidad = qty_available($this->producto->id,$this->sucursal);

    }


    public function addItem(){
        if($this->precios == '1') $precio_venta = $this->producto->precio_letal;
        else $precio_venta = $this->producto->precio_mayor;
        $this->options['puntos'] = $this->producto->puntos;

        Cart::add([ 'id' => $this->producto->id, 
                    'name' => $this->producto->nombre, 
                    'qty' => $this->qty, 
                    'price' => $precio_venta, 
                    'weight' => 0,
                    'options' => $this->options,
                ]);

         $this->cantidad = qty_available($this->producto->id,$this->sucursal);

        $this->reset('qty');
        $this->isopen = false;

    
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false; 
        $this->reset('qty'); 
    }


    public function render()
    {

        
        return view('livewire.ventas.ventas-seleccion-cantidades');
    }
}
