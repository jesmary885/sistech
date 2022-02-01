<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento;
use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;
use Carbon\Carbon;

class ProductosHistorial extends Component
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
        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
          ->orwhere('cod_barra', 'LIKE', '%' . $this->search . '%')
          ->paginate(5);

        return view('livewire.productos.productos-historial',compact('productos'));
    }


    public function select_product($producto_id){

        $rules = $this->rules;
        $this->validate($rules);
        
        $producto = Producto::where('id',$producto_id)->first();
        $fecha_inicio = Carbon::parse($this->fecha_inicio);
        $fecha_fin = carbon::parse($this->fecha_fin);

        return redirect()->route('movimientos.historial.detalle', ['producto' => $producto,'fecha_inicio'=> $fecha_inicio, 'fecha_fin' => $fecha_fin]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    
}
