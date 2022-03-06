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

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Eliminar un producto de la venta: Haga click en el botón " <i class="fas fa-trash"></i> ", ubicado al lado del producto que desea eliminar.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-.Eliminar todos los productos de la venta: Haga click en el botón " <i class="fas fa-trash"></i> Borrar todos los productos ", ubicado en el área inferior izquierda del listado de productos.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Continuar con la venta: Haga click sobre el botón "Continuar>>" ubicado en la zona inferior izquierda </p>');
    }
    
}
