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
          ->latest('id')
          ->paginate(5);

        return view('livewire.productos.productos-historial',compact('productos'));
    }


    public function select_product($producto_id){

        $rules = $this->rules;
        $this->validate($rules);
        
        $producto = Producto::where('id',$producto_id)->first();
        $fecha_inicio = Carbon::parse($this->fecha_inicio);
        $fecha_fin = carbon::parse($this->fecha_fin);
        $vista = 'cod_barra';

        return redirect()->route('movimientos.historial.detalle', ['producto' => $producto,'fecha_inicio'=> $fecha_inicio, 'fecha_fin' => $fecha_fin, 'vista' => $vista]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">Para generar el reporte de los movimientos del equipo, ingrese el periodo de fechas en que desee generar el reporte y haga click al boton "<i class="fas fa-check"></i>" ubicado al lado del equipo que desea seleccionar');
    }
    
}
