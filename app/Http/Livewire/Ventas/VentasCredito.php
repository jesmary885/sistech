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

    public $productos,$collection = [], $venta;


    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

   
    public function render()
    {
    

        $ventas = Venta::where('fecha', 'LIKE', '%' . $this->search . '%')
                        ->where('tipo_pago', 2)
                        ->where('estado', 'activa')
                        ->latest('id')
                        ->paginate(5);
        return view('livewire.ventas.ventas-credito',compact('ventas'));
    }

    public function delete($ventaId){
        $this->venta = $ventaId;

        $this->emit('confirm', 'Esta seguro de anular esta venta?','ventas.ventas-credito','confirmacion','La venta se ha anulado.');
    }

    public function confirmacion(){
        $venta_destroy = Venta::where('id',$this->venta)->first();
        $venta_destroy->update([
            'estado' => 'anulada',
        ]);
    }


}
