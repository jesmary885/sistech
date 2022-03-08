<?php

namespace App\Http\Livewire\Productos;

use App\Models\Devolucion;
use App\Models\Producto;
use App\Models\Producto_sucursal;
use App\Models\Producto_venta;
use App\Models\ProductoSerialSucursal;
use App\Models\Venta;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosDevolucion extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];
    public $search,$product_select,$devolucion_id,$venta_id,$producto_id, $sucursal_id;

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
     //   $this->producto_select = ProductoSerialSucursal::where('id',$DevolucionProductoId)->first();
        $busqueda_sucursal = Venta::where('id',$ventaId)->first();
        $this->sucursal_id = $busqueda_sucursal->sucursal_id;
        //$this->venta_id = $ventaId;
        $this->devolucion_id = $devolucionId;
        $this->producto_id = $DevolucionProductoId;
        $this->emit('confirm', 'Esta seguro de enviar el producto a inventario?','productos.productos-devolucion','confirmacion','El producto ha sido registrado en inventario.');
       
    }

    public function confirmacion(){
        
        $devolucion_eliminar = Devolucion::where('id',$this->devolucion_id)->first();
        $devolucion_eliminar->delete();

        $producto_sucursal= Producto_sucursal::where('sucursal_id',$this->sucursal_id)
                                            ->where('producto_id',$this->producto_id)
                                            ->first();

        $cantidad_nueva_producto = $producto_sucursal->cantidad + 1;
        $producto_sucursal->update([
            'cantidad' => $cantidad_nueva_producto
        ]);

        $producto_serial = ProductoSerialSucursal::where('id',$this->producto_id)->first();
        $producto_serial->update([
            'estado' => 'activo'
        ]);

    }

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Registro de devolución: Haga click en el botón "<i class="fas fa-exchange-alt"></i>  Registro de devolución", ubicado en la zona superior derecha.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-.Regresar equipo a inventario como activo: Haga click en el botón "<i class="fas fa-exchange-alt"></i>", ubicado al lado de la devolución asociada al equipo que desea reintegrar al inventario, el sistema le solicitará confirmación.</p>');
    }
}
