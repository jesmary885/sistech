<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use App\Models\Producto_sucursal;
use App\Models\Producto_venta;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
Use Livewire\WithPagination;

class ProductosIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];


    public $search, $producto,$buscador;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {


        $sucursales = Sucursal::all();

        if($this->buscador == 0){
            $productos = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
            ->orwhere('cod_barra', 'LIKE', '%' . $this->search . '%')
            ->where('estado',1)
            ->paginate(5);
            
            $this->item_buscar = "el código de barra o nombre del producto a buscar";
        }

        if($this->buscador == 1){

            $productos = Producto::whereHas('categoria',function(Builder $query){
                $query->where('nombre','LIKE', '%' . $this->search . '%')
                ->where('estado',1);
            })->paginate(5);

            $this->item_buscar = "la categoria del producto a buscar";
        }

        
        if($this->buscador == 2){

            $productos = Producto::whereHas('marca',function(Builder $query){
                $query->where('nombre','LIKE', '%' . $this->search . '%')
                ->where('estado',1);
            })->paginate(5);

            $this->item_buscar = "la marca del producto a buscar";
        }

        if($this->buscador == 3){

            $productos = Producto::whereHas('modelo',function(Builder $query){
                $query->where('nombre','LIKE', '%' . $this->search . '%')
                ->where('estado',1);
            })->paginate(5);

            $this->item_buscar = "el modelo del producto a buscar";
        }

        
        return view('livewire.productos.productos-index',compact('productos','sucursales'));

    }

    public function delete($productoId){
        $this->producto = $productoId;
       
       // $busqueda = Producto_venta::where('producto_id',$productoId)->first();

        $busqueda = Producto_venta::whereHas('productoSerialSucursal',function(Builder $query){
            $query->where('producto_id',$this->producto);
         })->first();

        if($busqueda) $this->emit('errorSize', 'Este producto esta asociado a una venta, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este producto?','productos.productos-index','confirmacion','El producto se ha eliminado.');
    }

    public function confirmacion(){
        $this->fecha_actual = date('Y-m-d');
        $usuario_auth = Auth::id();
        $user_auth_nombre =  auth()->user();

        $producto_destroy = Producto::where('id',$this->producto)->first();
        
        $producto_destroy->update([
            'estado' => 'inactivo por eliminación, por usuario'. $user_auth_nombre->nombre. ' ' . $user_auth_nombre->apellido. 'en fecha:' .$this->fecha_actual,
        ]);

        $productos_seriales = Producto_sucursal::where('producto_id',$producto_destroy->id)->get();
        foreach($productos_seriales as $ps){
            $ps->update([
                'estado' => 'inactivo por eliminación, por usuario'. $usuario_auth . 'en fecha:' .$this->fecha_actual,
            ]);
        }
        $this->resetPage();
    }

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Registro de equipos: Haga click en el botón "<i class="fas fa-plus-square"></i> Nuevo equipo", ubicado en la zona superior derecha y complete el formulario.</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-.Exportar inventario: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Agregar unidades a un tipo de equipo: Haga click en el botón "<i class="fas fa-plus-square"></i>" ubicado eal lado de cada equipo registrado y complete el formulario.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">4-.Editar información de equipos: Haga click en el botón "<i class="far fa-edit"></i>" ubicado al lado de cada equipo, complete el formulario y haga click en Guardar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">5-.Ver stock de equipos por almacen: Haga click en el botón "<i class="fas fa-warehouse"></i>" ubicado al lado del stock de cada equipo y le aparecerá la información detallada por sucursal.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">6-.Imrpimir códigos de barra: Haga click en el botón "<i class="far fa-file-excel"></i> Exportar inventario" ubicado en la zona superior derecha, complete el formulario y haga click en Exportar.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">7-.Eliminar equipo: Haga click en el botón "<i class="fas fa-trash-alt"></i>", si el equipo esta asociado a alguna venta no podrá eliminarlo, de lo contrario el sistema solicitará confirmación.</p>');
    }

   
}
