<?php

namespace App\Http\Livewire\Admin\Compras;

use Livewire\Component;

class CompraImport extends Component
{
    public $isopen = false,$file;

      
    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function render()
    {
        return view('livewire.admin.compras.compra-import');
    }
}
