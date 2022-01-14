<?php

namespace App\Http\Livewire\Ventas;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;

class VentasSeleccionCantidades extends Component
{

    public $isopen = false;
    public $producto, $cantidad;
    public $qty = 1;

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem(){
        Cart::add([ 'id' => $this->producto->id, 
                    'name' => $this->producto->nombre, 
                    'qty' => $this->qty, 
                    'price' => $this->producto->precio_letal, 
                    'weight' => 0,
                ]);

         $this->cantidad = qty_available($this->producto->id);

        $this->reset('qty');

        $this->emitTo('ventas.ventas-seleccion-cantidades', 'render');
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
