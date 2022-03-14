<?php

namespace App\Http\Livewire\MovimientosCaja;

use App\Models\MovimientoCaja;
use Livewire\Component;
use Livewire\WithPagination;

class MovimientoView extends Component
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
        $movimientos = MovimientoCaja::where('fecha', 'LIKE', '%' . $this->search . '%')
                    ->orwhere('tipo_movimiento', 'LIKE', '%' . $this->search . '%')
                    ->latest('id')
                    ->paginate(5);

        return view('livewire.movimientos-caja.movimiento-view',compact('movimientos'));
    }
}
