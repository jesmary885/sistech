<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class VentasContado extends Component
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

        $ventas = Venta::where('fecha', 'LIKE', '%' . $this->search . '%')
                    ->where('tipo_pago', 1)
                    // ->orwhereHas('cliente',function(Builder $query){
                    //     $query->where('nro_documento','LIKE', '%' . $this->search . '%');
                    // })
                    ->latest('id')
                    ->paginate(5);
        return view('livewire.ventas.ventas-contado',compact('ventas'));
    }

   
}
