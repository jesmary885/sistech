<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use App\Models\Producto_venta;
use App\Models\Sucursal;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];


    public $search, $producto;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $sucursales = Sucursal::all();

        $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orwhere('cod_barra', 'LIKE', '%' . $this->search . '%')
                    ->latest('id')
                    ->paginate(5);
        
        return view('livewire.productos.productos-index',compact('productos','sucursales'));

    }

    public function delete($productoId){
        $this->producto = $productoId;
        $busqueda = Producto_venta::where('producto_id',$productoId)->first();

        if($busqueda) $this->emit('errorSize', 'Este producto esta asociado a una venta, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este producto?','productos.productos-index','confirmacion','El producto se ha eliminado.');
    }

    public function confirmacion(){
        $producto_destroy = Producto::where('id',$this->producto)->first();
        $producto_destroy->delete();
    }

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Registro de equipos: Haga click en el botón "<i class="fas fa-plus-square"></i> Nuevo equipo", ubicado en la zona superior derecha y complete el formulario.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-.Exportar inventario: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Agregar unidades a un tipo de equipo: Haga click en el botón "<i class="fas fa-plus-square"></i>" ubicado eal lado de cada equipo registrado y complete el formulario.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Exportar inventario: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Exportar inventario: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Exportar inventario: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Exportar inventario: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>');
    }
}
