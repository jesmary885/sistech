<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;

class ProductosDevolucionAdd extends Component
{
    public $isopen = false;
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

    public function save(){
        
    }
}
