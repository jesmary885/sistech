<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento_product_serial;
use App\Models\ProductoSerialSucursal;
use App\Models\Sucursal;
use App\Models\Traslado;
use App\Models\Producto_sucursal as Pivot;
use App\Models\ProductosTraslado;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ProductosDetalleTrasladoRecibir extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];


    public $sucursal, $cantidad, $sucursal_id = "", $sucursales,$prod, $prodr, $search2,$buscador,$item_buscar;

    public function updatingSearch2(){
        $this->resetPage();
    }

    public function render()
    {

      /*  $trasl = ProductosTraslado:://where('serial', 'LIKE', '%' . $this->search2 . '%')
        where('sucursal_id',$this->sucursal)
        ->Paginate(5);*/


        /*$trasl = ProductosTraslado::where('sucursal_id',$this->sucursal)
                    ->whereHas('productoSerialSucursal',function(Builder $query){
                        $query->where('serial','LIKE', '%' . $this->search2 . '%');       
                        })
                        ->paginate(5);*/

                        if($this->buscador==0){
                            $trasl = ProductosTraslado::where('sucursal_id',$this->sucursal)
                            ->whereHas('producto',function(Builder $query){
                                $query->where('cod_barra','LIKE', '%' . $this->search2 . '%');       
                                })
                                ->paginate(10);

                            $this->item_buscar = "el código de barra del producto a buscar ";

                        }
                        else{
                            $trasl = ProductosTraslado::where('sucursal_id',$this->sucursal)
                            ->whereHas('producto',function(Builder $query){
                                $query->where('nombre','LIKE', '%' . $this->search2 . '%');       
                                })
                                ->paginate(10);

                            $this->item_buscar = "el nombre del producto a buscar ";

                        }
                      

        


     /*   $productos = ProductoSerialSucursal::whereHas('modelo',function(Builder $query){
            $query->where('nombre','LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo');
         })->paginate(5);*/


        return view('livewire.productos.productos-detalle-traslado-recibir',compact('trasl'));
    }

    public  function recibir($producto)
    {

        $fecha_actual = date('Y-m-d');
        $user_auth_nombre =  auth()->user()->name;
        $user_auth_apellido =  auth()->user()->apellido;


        
        $producto_delete = ProductosTraslado::where('id',$producto)
                                            ->first();

        $sucursal = Sucursal::where('id',$producto_delete->sucursal_id)->first();

            $pivot_increment = Pivot::where('sucursal_id', $producto_delete->sucursal_id)->where('producto_id', $producto_delete->producto_id)->first();
            $pivot_increment->cantidad = $pivot_increment->cantidad + $producto_delete->cantidad;
            $pivot_increment->save();



            $traslado_pendiente_delete = Traslado::where('sucursal_origen',$producto_delete->sucursal_origen)
                                            ->where('sucursal_id',$producto_delete->sucursal_id)
                                            ->where('producto_id',$producto_delete->producto_id)
                                            ->first(); 

            $traslado_pendiente_delete->update([
                        'cantidad_recibida' => $producto_delete->cantidad,
                        'estado' => 'RECIBIDO',
                        'observacion_final' => 'Recibido en almacen '. $sucursal->nombre .', por usuario '. $user_auth_nombre .' '. $user_auth_apellido. ' Fecha del registro: '. $fecha_actual
            ]);

            $producto_delete->delete();
            
            $this->emitTo('productos.productos-traslado-recibir','render');


    }


    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Seleccionar sucursal destino: Seleccione la sucursal destino en el select ubicado en la zona superior izquierda</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-. Seleccionar equipos por serial a trasladar: Haga click en el check cuadrado ubicado al lado de cada equipo.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-. Procesar traslado: Una vez haya seleccionado todos los equipos a trasladar haga click en el botón Procesar</p>');
    }
}
