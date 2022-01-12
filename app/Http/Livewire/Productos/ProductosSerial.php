<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto_cod_barra_serial;
Use Livewire\WithPagination;
use Livewire\Component;


class ProductosSerial extends Component
{

    public $producto, $search;
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners =['render'];

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function order($sort)
    {
        if ($this->sort == $sort)
        {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        }
        else{
            $this->sort=$sort;
            $this->direction='asc';
        }
    }

    public function render()
    {

        $productos_seriales = Producto_cod_barra_serial::where('producto_id',$this->producto->id)
                                                        ->OrderBy($this->sort, $this->direction)              
                                                        ->paginate(6);
        
        return view('livewire.productos.productos-serial',compact('productos_seriales'));
    }
}
