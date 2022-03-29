<?php

namespace App\Http\Livewire\Ventas;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto_sucursal as Pivot;
use App\Models\User;
use Livewire\Component;

class VentasSeleccionCantidades extends Component
{

    public $isopen = false;
    public $producto, $sucursal, $precios, $usuario, $change_price, $precio_manual;
    public $qty = 1;

    public $options = [
        'puntos' => null,
        'serial' => null,
    ];



    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function mount(){


    }


    public function addItem(){

        

        $exist = 0;

        foreach(Cart::content() as $item){
            if($item->id == $this->producto->id){
                $exist = 1;
            }
        }

        if($exist == 0){
            if($this->precios == 1) $precio_venta = $this->producto->producto->precio_letal;
            elseif($this->precios == 2) $precio_venta = $this->producto->producto->precio_mayor;
            elseif($this->precios == 3) $precio_venta = $this->precio_manual;
            
            $this->options['puntos'] = $this->producto->producto->puntos;
            $this->options['serial'] = $this->producto->serial;

            Cart::add([ 'id' => $this->producto->id, 
                        'name' => $this->producto->producto->nombre, 
                        'qty' => 1, 
                        'price' => $precio_venta, 
                        'weight' => 0,
                        'options' => $this->options,
                    ]);

      //   $this->cantidad = qty_available($this->producto->id,$this->sucursal);

        $this->reset('precios');
        $this->isopen = false;
        $this->emitTo('ventas.ventas-cart','render');

        }
        else{
            $this->emit('errorSize', 'Ya agregaste este producto al carrito');
        }
       

    
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

        
      $usuario_aut = User::where('id',$this->usuario)->first();



      if($usuario_aut->changePrice == 'si') $this->change_price = 'si';
      elseif ($usuario_aut->changePrice == 'no') $this->change_price = 'no';

        
        return view('livewire.ventas.ventas-seleccion-cantidades');
    }
}
