<?php

namespace App\Http\Livewire\Productos;

use App\Models\ProductoSerialSucursal;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosSerialIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $sort = 'id';
    public $direction = 'desc';


    protected $listeners = ['render' => 'render'];

    public $search,$sucursal;


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
        $productos = ProductoSerialSucursal::where('sucursal_id',$this->sucursal)
        ->where('cod_barra', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->OrderBy($this->sort, $this->direction) 
        ->paginate(5);

        return view('livewire.productos.productos-serial-index',compact('productos'));
    }
}
