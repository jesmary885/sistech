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
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Editar compras: Haga click en el botón " <i class="fas fa-edit"></i> ", ubicado al lado de cada compra y complete el formulario.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-.Eliminar compra: Haga click en el botón " <i class="fas fa-trash-alt"></i> ", ubicado al lado de cada compra, confirme haciendo click en la opción " Si, seguro " .</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Registro de compras: Al registrar el producto recibido automáticamente se registra la compra, por ende para registrar compras debe registrar el producto o agregar unidades al producto comprado.</p>');
    }
    
}
