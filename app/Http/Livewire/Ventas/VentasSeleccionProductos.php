<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;


class VentasSeleccionProductos extends Component
{

    public $search, $sucursal,$pivot;


    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $sucursal = $this->sucursal;

        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->orwhere('Cod_barra', 'LIKE', '%' . $this->search . '%')
         ->paginate(5);

        return view('livewire.ventas.ventas-seleccion-productos',compact('productos','sucursal'));
    }
}
