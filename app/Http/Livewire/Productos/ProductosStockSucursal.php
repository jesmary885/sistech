<?php

namespace App\Http\Livewire\Productos;

use App\Models\Sucursal;
use Livewire\Component;

class ProductosStockSucursal extends Component
{

    public $producto,$cant;
    public $isopen = false;

    public function render()
    {

        $sucursales = Sucursal::all();

        return view('livewire.productos.productos-stock-sucursal',compact('sucursales'));
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

}
