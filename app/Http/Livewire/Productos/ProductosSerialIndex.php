<?php

namespace App\Http\Livewire\Productos;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Producto_sucursal;
use App\Models\Producto_venta;
use App\Models\ProductoSerialSucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosSerialIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search,$sucursal,$producto,$fecha_actual;


    public function updatingSearch(){
        $this->resetPage();
    }

   


    public function render()
    {
        $productos = ProductoSerialSucursal::where('sucursal_id',$this->sucursal)
        ->where('estado','activo')
        ->where('cod_barra', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.productos.productos-serial-index',compact('productos'));
    }

    public function delete($productoId){
        $this->producto = $productoId;
        $busqueda = Producto_venta::where('producto_serial_sucursal_id',$productoId)->first();

        if($busqueda) $this->emit('errorSize', 'Este producto esta asociado a una venta, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este producto?','productos.productos-serial-index','confirmacion','El producto se ha eliminado.');
    }

    public function confirmacion(){
        $this->fecha_actual = date('Y-m-d');
        $usuario_auth = Auth::id();

        //Eliminando producto seleccionado
        $producto_destroy = ProductoSerialSucursal::where('id',$this->producto)->first();
        $producto_destroy->delete();

        $producto=Producto::where('id',$producto_destroy->producto_id)->first();

        //Disminuyendo a uno cantidades en tabla producto_sucursal
        $producto_cod_barra = Producto_sucursal::where('producto_id',$producto_destroy->producto_id)
                                                ->where('sucursal_id',$this->sucursal)->first();

        $new_can_producto_cod_barra = $producto_cod_barra->cantidad - 1;
        $producto_cod_barra->update([
            'cantidad' => $new_can_producto_cod_barra,
        ]);

        //Buscar en la tabla compra y disminuir a 1 la cantidad y modificar el total

        $producto_compra = Compra::where('id',$producto_destroy->compra_id)
                                    ->where('producto_id',$producto_destroy->producto_id)->first();

        $cantidad_compra_new = $producto_compra->cantidad - 1;
        $total_compra_new = $producto_compra->precio_compra * $cantidad_compra_new;

        $producto_compra->update([
            'total' => $total_compra_new,
            'cantidad' => $cantidad_compra_new,
        ]);

     
        //registrando moviemientos en tabla movimientos
        $producto->movimientos()->create([
            'fecha' => $this->fecha_actual,
            'tipo_movimiento' => 'Eliminación de unidad',
            'cantidad' => '1',
            'precio' => $producto->precio_letal,
            'observacion' => 'Se ha eliminado la unidad con serial '.' '.$producto_destroy->serial,
            'user_id' => $usuario_auth
        ]);




       



    }

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Agregar serial a equipo: Haga click en el botón "<i class="fas fa-edit"></i>", ubicado al lado de cada equipo.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-.Eliminar equipo: Haga click en el botón "<i class="fas fa-trash-alt"></i>", ubicado al lado de cada equipo el sistema solicitará confirmación.</p>');
    }

}
