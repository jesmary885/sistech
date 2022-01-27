<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosTraslado extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$sucursal;


    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orwhere('cod_barra', 'LIKE', '%' . $this->search . '%')
                    ->paginate(5);

        return view('livewire.productos.productos-traslado',compact('productos'));
    }
}
