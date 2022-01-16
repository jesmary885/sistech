<?php

namespace App\Http\Livewire\Ventas;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class VentasCart extends Component
{

    public $sucursal,$producto;

    protected $listeners = ['render'];

    public function destroy(){
        Cart::destroy();

        $this->emitTo('dropdown-cart', 'render');
    }

    public function delete($rowID){
        Cart::remove($rowID);
        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {

        $sucursal = $this->sucursal;
        $producto = $this->producto;
        return view('livewire.ventas.ventas-cart',compact('sucursal','producto'));
    }
}
