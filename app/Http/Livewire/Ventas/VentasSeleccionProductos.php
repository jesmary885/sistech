<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto;
use App\Models\ProductoSerialSucursal;
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


        $productos = ProductoSerialSucursal::where('cod_barra', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo')
            ->paginate(5);

        return view('livewire.ventas.ventas-seleccion-productos',compact('productos','sucursal'));
    }
}
