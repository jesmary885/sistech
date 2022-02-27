<?php

namespace App\Http\Livewire\Productos;

use App\Models\ProductoSerialSucursal;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosHistorialProdSerial extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search, $fecha_inicio, $fecha_fin;

    protected $rules = [
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        ];

    public function render()
    {
        $productos = ProductoSerialSucursal::where('serial', 'LIKE', '%' . $this->search . '%')
        ->orwhere('cod_barra', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.productos.productos-historial-prod-serial',compact('productos'));
    }

    public function select_product($producto_id){

        $rules = $this->rules;
        $this->validate($rules);
        
        $producto = ProductoSerialSucursal::where('id',$producto_id)->first();
        $fecha_inicio = Carbon::parse($this->fecha_inicio);
        $fecha_fin = carbon::parse($this->fecha_fin);
        $vista = 'serial';

        return redirect()->route('movimientos.historial.detalle', ['producto' => $producto,'fecha_inicio'=> $fecha_inicio, 'fecha_fin' => $fecha_fin, 'vista' => $vista]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

}
