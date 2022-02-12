<?php

namespace App\Http\Livewire\Productos;

use App\Exports\MovimientoExport;
use App\Models\Movimiento;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductosDetalleHistorial extends Component
{

    public $producto, $fecha_fin, $fecha_inicio;

    use WithPagination;
    protected $paginationTheme = "bootstrap";
   
    public function render()
    {

        $movimientos = Movimiento::where('producto_id',$this->producto)
        ->whereBetween('fecha',[$this->fecha_inicio,$this->fecha_fin])
        ->latest('id')
        ->paginate(5);

        return view('livewire.productos.productos-detalle-historial',compact('movimientos'));
    }

    public function export(){
        $fecha_inicio = date("d-m-Y", strtotime($this->fecha_inicio));
        $fecha_fin = date("d-m-Y", strtotime($this->fecha_fin));
        $producto = Producto::where('id',$this->producto)->first();

        $nombre_producto = $producto->nombre;
        $cod_barra_producto = $producto->cod_barra;

        $array = Movimiento::where('producto_id',$this->producto)
                        ->whereBetween('fecha',[$this->fecha_inicio,$this->fecha_fin])->get();

        return Excel::download(new MovimientoExport($array,$fecha_inicio,$fecha_fin,$nombre_producto,$cod_barra_producto), 'ReporteMovimientoProducto.xlsx');
    }

}
