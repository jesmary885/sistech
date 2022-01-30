<?php

namespace App\Http\Livewire\Productos;

use App\Models\Devolucion;
use App\Models\Producto;
use App\Models\Producto_venta;
use App\Models\Venta;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosDevolucion extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];
    public $search,$product_select,$devolucion_id,$venta_id,$producto_id;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $devoluciones = Devolucion::where('fecha', 'LIKE', '%' . $this->search . '%')
                    ->paginate(5);
        return view('livewire.productos.productos-devolucion',compact('devoluciones'));
    }

    public function inventariar($DevolucionProductoId,$devolucionId,$ventaId){
        $this->producto_select = Producto::where('id',$DevolucionProductoId)->first();
        $this->venta_id = $ventaId;
        $this->devolucion_id = $devolucionId;
        $this->producto_id = $DevolucionProductoId;
        $this->emit('confirm', 'Esta seguro de enviar el producto a inventario?');
       
    }

    public function confirmacion(){
        
        $devolucion_eliminar = Devolucion::where('id',$this->devolucion_id)->first();
        $devolucion_eliminar->delete();

        $cantidad_nueva_producto = $this->producto_select->cantidad + 1;
        $this->producto_select->update([
            'cantidad' => $cantidad_nueva_producto
        ]);

    }
}
