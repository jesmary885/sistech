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

    public $isopen = false;
    public $sucursal, $cantidad, $sucursal_id = "", $sucursales,$prod, $prodr, $search2;

    public function updatingSearch2(){
        $this->resetPage();
    }

    public function render()
    {

      /*  $trasl = ProductosTraslado:://where('serial', 'LIKE', '%' . $this->search2 . '%')
        where('sucursal_id',$this->sucursal)
        ->Paginate(5);*/


        $trasl = ProductosTraslado::where('sucursal_id',$this->sucursal)
                    ->whereHas('productoSerialSucursal',function(Builder $query){
                        $query->where('serial','LIKE', '%' . $this->search2 . '%');       
                        })
                        ->paginate(5);

        


     /*   $productos = ProductoSerialSucursal::whereHas('modelo',function(Builder $query){
            $query->where('nombre','LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo');
         })->paginate(5);*/


        return view('livewire.productos.productos-detalle-traslado-recibir',compact('trasl'));
    }

    public  function ingresar()
    {
     
        $cant = 0;
        $fecha_actual = date('Y-m-d');
        $user_auth =  auth()->user()->id;
        $user_auth_nombre =  auth()->user()->name;
        $user_auth_apellido =  auth()->user()->apellido;

       foreach($this->prodr as $pp){

       

            $producr=ProductoSerialSucursal::where('serial',$pp)->first();
            $sucursal = Sucursal::where('id',$this->sucursal)->first();

    

            $product_destroy = ProductosTraslado::where('producto_serial_sucursal_id',$producr->id)->first();
            $product_destroy->delete();

            $producr->update([
                'estado' => 'activo',
                'sucursal_id' => $this->sucursal
            ]);

            $movimiento_serial = Movimiento_product_serial:: where('producto_serial_sucursal_id',$producr->id)->first();
            $movimiento_serial = new Movimiento_product_serial();
            $movimiento_serial->fecha = $fecha_actual;
            $movimiento_serial->tipo_movimiento = 'Traslado';
            $movimiento_serial->precio =  $producr->producto->precio_letal;
            $movimiento_serial->observacion = 'Traslado (recibido) en almacen '. $sucursal->nombre;
            $movimiento_serial->producto_serial_sucursal_id = $producr->id;
            $movimiento_serial->user_id = $user_auth;
            $movimiento_serial->save();

           

            
            $traslado = Traslado::where('producto_serial_sucursal_id',$producr->id)
                                ->where('estado','PENDIENTE')
                                ->first();
            $traslado->update([
                'observacion_final' => 'Recibido en almacen '. $sucursal->nombre .', por usuario '. $user_auth_nombre .' '. $user_auth_apellido. ' Fecha del registro: '. $fecha_actual,
                'estado' => 'RECIBIDO'
            ]);
           
            $traslado->save();

         
            $pivot_increment = Pivot::where('sucursal_id',$this->sucursal)->where('producto_id',$producr->producto_id)->first(); 
            $pivot_increment->cantidad = $pivot_increment->cantidad + 1;
            $pivot_increment->save();

            $cant++;
        }

        $this->reset(['prod','prodr']);
        $this->emitTo('productos.productos-detalle-traslado','render');
        $this->resetPage();
        $this->emit('alert','Datos registrados correctamente');

    }


    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Seleccionar sucursal destino: Seleccione la sucursal destino en el select ubicado en la zona superior izquierda</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-. Seleccionar equipos por serial a trasladar: Haga click en el check cuadrado ubicado al lado de cada equipo.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-. Procesar traslado: Una vez haya seleccionado todos los equipos a trasladar haga click en el botón Procesar</p>');
    }
}
