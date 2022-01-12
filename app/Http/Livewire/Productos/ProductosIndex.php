<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use App\Models\Sucursal;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $sucursales = Sucursal::all();

        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                  //  ->orwhere('marca', 'LIKE', '%' . $this->search . '%')
                    ->paginate();
        
        return view('livewire.productos.productos-index',compact('productos','sucursales'));

    }
}
