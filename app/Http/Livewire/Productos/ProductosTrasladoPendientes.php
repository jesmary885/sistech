<?php

namespace App\Http\Livewire\Productos;

use App\Models\ProductosTraslado;
use App\Models\Traslado;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto_sucursal as Pivot;

class ProductosTrasladoPendientes extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

   
    public $sucursal;

    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $productos_pendientes=ProductosTraslado::where('sucursal_origen',$this->sucursal)
                                                ->paginate(10);

       // dd($productos_pendientes);

        return view('livewire.productos.productos-traslado-pendientes',compact('productos_pendientes'));
    }

    public function less($producto){
        //dd($producto);
        $fecha_actual = date('Y-m-d');
        $user_auth_nombre =  auth()->user()->name;
        $user_auth_apellido =  auth()->user()->apellido;

        $producto_less = ProductosTraslado::where('id',$producto)
                                            ->first();
        //dd($producto_less);
  
        
        
        if($producto_less->cantidad == '1'){

            $pivot_increment = Pivot::where('sucursal_id', $producto_less->sucursal_origen)->where('producto_id', $producto_less->producto_id)->first();
            $pivot_increment->cantidad = $pivot_increment->cantidad + $producto_less->cantidad;
            $pivot_increment->save();

            $traslado_pendiente_less = Traslado::where('sucursal_origen',$producto_less->sucursal_origen)
                                            ->where('sucursal_id',$producto_less->sucursal_id)
                                            ->where('producto_id',$producto_less->producto_id)
                                            ->first(); 

            $traslado_pendiente_less->update([
                        'cantidad_enviada' => 0,
                        'observacion_inicial' => '. Se ha anulado el traslado por el usuario' . $user_auth_nombre . ' ' . $user_auth_apellido . ' Fecha del registro: ' . $fecha_actual,
                        'estado' => 'ANULADA',
                        'observacion_final' => 'Traslado Anulado'
            ]);

            $producto_less->delete();
        }   
        else{
           // dd($producto_less->producto_id);
            $producto_less->update([
                'cantidad' => $producto_less->cantidad - 1
            ]);
            $traslado_pendiente_less = Traslado::where('sucursal_origen',$producto_less->sucursal_origen)
                                            ->where('sucursal_id',$producto_less->sucursal_id)
                                            ->where('producto_id',$producto_less->producto_id)
                                            ->first(); 
           // dd($traslado_pendiente_less);

            $traslado_pendiente_less->update([
                        'cantidad_enviada' => $traslado_pendiente_less->cantidad_enviada - 1,
                        'observacion_inicial' =>'Se ha eliminado del traslado una unidad del producto por usuario ' . $user_auth_nombre . ' ' . $user_auth_apellido . ' Fecha del registro de la modificación: ' . $fecha_actual,
            ]);

            $pivot_increment = Pivot::where('sucursal_id', $producto_less->sucursal_origen)->where('producto_id', $producto_less->producto_id)->first();
            $pivot_increment->cantidad = $pivot_increment->cantidad + 1;
            $pivot_increment->save();
        }  
        
    $this->emitTo('productos.productos-detalle-traslado','render');
    $this->emitTo('productos.productos-traslado-pendientes','render');

    }

    public function delete($producto){
        $fecha_actual = date('Y-m-d');
        $user_auth_nombre =  auth()->user()->name;
        $user_auth_apellido =  auth()->user()->apellido;


        
        $producto_delete = ProductosTraslado::where('id',$producto)
                                            ->first();

            $pivot_increment = Pivot::where('sucursal_id', $producto_delete->sucursal_origen)->where('producto_id', $producto_delete->producto_id)->first();
            $pivot_increment->cantidad = $pivot_increment->cantidad + $producto_delete->cantidad;
            $pivot_increment->save();

            $traslado_pendiente_delete = Traslado::where('sucursal_origen',$producto_delete->sucursal_origen)
                                            ->where('sucursal_id',$producto_delete->sucursal_id)
                                            ->where('producto_id',$producto_delete->producto_id)
                                            ->first(); 

            $traslado_pendiente_delete->update([
                        'cantidad_enviada' => 0,
                        'observacion_inicial' =>'. Se ha anulado el traslado por el usuario' . $user_auth_nombre . ' ' . $user_auth_apellido . ' Fecha del registro: ' . $fecha_actual,
                        'estado' => 'ANULADA',
                        'observacion_final' => 'Traslado Anulado'
            ]);

            $producto_delete->delete();

    $this->emitTo('productos.productos-detalle-traslado','render');
    $this->emitTo('productos.productos-traslado-pendientes','render');
     
                                     

    }


}
