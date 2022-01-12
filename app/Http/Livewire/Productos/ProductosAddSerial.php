<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto_cod_barra_serial;
use Livewire\Component;

class ProductosAddSerial extends Component
{

    public $isopen = false;
    public $serial, $producto;
      
    protected $rules = [
        'serial' => 'required|unique:producto_cod_barra_serials',
    ];

     public function mount(){
        $this->serial = $this->producto->serial;
      }
    public function render()
    {
        return view('livewire.productos.productos-add-serial');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function save()
    {
        $rules = $this->rules;
        $this->validate($rules);
         $this->producto->update([
             'serial' => $this->serial
         ]);
        $this->reset(['isopen']);
        $this->emitTo('productos.productos-serial','render');
        $this->emit('alert','Datos registrados correctamente');
    }

   
}
