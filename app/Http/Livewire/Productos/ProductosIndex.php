<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                  //  ->orwhere('marca', 'LIKE', '%' . $this->search . '%')
                    ->paginate();
        
        return view('livewire.productos.productos-index',compact('productos'));

    }
}
