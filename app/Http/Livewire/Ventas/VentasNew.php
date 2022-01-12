<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto;
use App\Models\Sucursal;
Use Livewire\WithPagination;
use Livewire\Component;

class VentasNew extends Component
{

    public $producto, $search;


    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                   ->orwhere('Cod_barra', 'LIKE', '%' . $this->search . '%')
                    ->paginate(5);
        
        return view('livewire.ventas.ventas-new', compact('productos'));
    }
}
