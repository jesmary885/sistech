<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosDetalleHistorial extends Component
{

    public $producto, $fecha_fin, $fecha_inicio;

    use WithPagination;
    protected $paginationTheme = "bootstrap";
   
    public function render()
    {

        $movimientos = Movimiento::where('producto_id',$this->producto)
        ->whereBetween('fecha',[$this->fecha_inicio,$this->fecha_fin])
        ->paginate(5);

        return view('livewire.productos.productos-detalle-historial',compact('movimientos'));
    }

}
