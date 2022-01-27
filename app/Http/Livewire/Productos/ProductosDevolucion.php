<?php

namespace App\Http\Livewire\Productos;

use App\Models\Devolucion;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosDevolucion extends Component
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
        $devoluciones = Devolucion::where('fecha', 'LIKE', '%' . $this->search . '%')
                    ->paginate(5);
        return view('livewire.productos.productos-devolucion',compact('devoluciones'));
    }
}
