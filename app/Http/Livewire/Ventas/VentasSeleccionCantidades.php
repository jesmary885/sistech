<?php

namespace App\Http\Livewire\Ventas;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto_sucursal as Pivot;

use Livewire\Component;

class VentasSeleccionCantidades extends Component
{

    public $isopen = false;
    public $producto, $sucursal;
    public $qty = 1;

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
        Cart::add([ 'id' => $this->producto->id, 
                    'name' => $this->producto->nombre, 
                    'qty' => $this->qty, 
                    'price' => $this->producto->precio_letal, 
                    'weight' => 0,
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
