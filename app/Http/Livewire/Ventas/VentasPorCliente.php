<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class VentasPorCliente extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $productos,$collection = [];


    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $ventas = Venta::whereHas('cliente',function(Builder $query){
            $query->where('nro_documento','LIKE', '%' . $this->search . '%');
         })->latest('id')
         ->paginate(5);



        return view('livewire.ventas.ventas-por-cliente',compact('ventas'));
    }

    public function delete($ventaId){
        $this->venta = $ventaId;

        $this->emit('confirm', 'Esta seguro de anular esta venta?','ventas.ventas-por-cliente','confirmacion','La venta se ha anulado.');
    }

    public function confirmacion(){
        $venta_destroy = Venta::where('id',$this->venta)->first();
        $venta_destroy->update([
            'estado' => 'anulada',
        ]);
    }

}
