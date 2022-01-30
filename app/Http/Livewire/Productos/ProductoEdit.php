<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;

class ProductoEdit extends Component
{

    public $isopen = false;


    public function render()
    {
        return view('livewire.productos.producto-edit');
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
