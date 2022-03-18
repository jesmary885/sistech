<?php

namespace App\Http\Livewire\MovimientosCaja;

use App\Models\MovimientoCaja;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class MovimientoView extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$sucursal,$buscador;

    public function updatingSearch(){
        $this->resetPage();
    }
   

    public function render()
    {
        if($this->buscador == 0){
            $movimientos = MovimientoCaja::where('sucursal_id', $this->sucursal)
            ->where('fecha', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(5);

        }
        elseif ($this->buscador == 1){
            $movimientos = MovimientoCaja::where('sucursal_id', $this->sucursal)
            ->whereHas('user',function(Builder $query){
                $query->where('name','LIKE','%' . $this->search . '%');
            })
            ->latest('id')
            ->paginate(5);

        }
       

                 


        

        return view('livewire.movimientos-caja.movimiento-view',compact('movimientos'));
    }
}