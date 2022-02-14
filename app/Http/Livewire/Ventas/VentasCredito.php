<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto_venta;
use App\Models\Venta;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class VentasCredito extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $productos,$collection = [];


    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

   
    public function render()
    {
    

        $ventas = Venta::where('fecha', 'LIKE', '%' . $this->search . '%')
                        ->where('tipo_pago', 2)
                        ->latest('id')
                        ->paginate(5);
        return view('livewire.ventas.ventas-credito',compact('ventas'));
    }

}
