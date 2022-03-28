<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento;
use App\Models\Movimiento_product_serial;
use App\Models\Producto;
use App\Models\Sucursal;
use Livewire\Component;
use App\Models\Producto_sucursal as Pivot;
use App\Models\ProductoSerialSucursal;
use App\Models\ProductosTraslado;
use App\Models\Traslado;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class ProductosDetalleTraslado extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $isopen = false;
    public $sucursal, $cantidad, $sucursal_id = "", $sucursales,$prod, $prodr;

    protected $listeners = ['render' => 'render'];
    
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

   
          
    protected $rules = [

        'sucursal_id' => 'required',
    ];

    public function mount(){
 
        //$this->sucursal = $sucursal;
             $this->sucursales=Sucursal::where('id','!=',$this->sucursal)->get();
     }
    public function render()
    {
      
       
       /* $productos = ProductoSerialSucursal::where('serial', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo')
            ->paginate(5);*/


            if($this->buscador == 0){
                $productos = ProductoSerialSucursal::whereHas('modelo',function(Builder $query){
                    $query->where('nombre','LIKE', '%' . $this->search . '%')
                    ->where('sucursal_id',$this->sucursal)
                    ->where('estado','activo');
                })->paginate(5);
    
                $this->item_buscar = "el modelo del producto a buscar ";
            }
            if($this->buscador == 1){
                $productos = ProductoSerialSucursal::whereHas('categoria',function(Builder $query){
                    $query->where('nombre','LIKE', '%' . $this->search . '%')
                    ->where('sucursal_id',$this->sucursal)
                    ->where('estado','activo');
                })->paginate(5);
    
                $this->item_buscar = "la categoria del producto a buscar ";
            }

            if($this->buscador == 2){
                $productos = ProductoSerialSucursal::where('cod_barra', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo')
            ->paginate(5);
    
                $this->item_buscar = "el código de barra del producto a buscar ";
            }

            if($this->buscador == 3){
                $productos = ProductoSerialSucursal::where('serial', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo')
            ->paginate(5);
    
                $this->item_buscar = "el serial del producto a buscar ";
            }


            

        return view('livewire.productos.productos-detalle-traslado',compact('productos'));
    }

    public  function save()
    {
    
        $rules = $this->rules;
        $this->validate($rules);
        $cant = 0;
        $fecha_actual = date('Y-m-d');
        $user_auth =  auth()->user()->id;
        $user_auth_nombre =  auth()->user()->name;
        $user_auth_apellido =  auth()->user()->apellido;
        
        $sucursal_inicial = Sucursal::where('id',$this->sucursal)->first()->nombre;
        $sucursal_final = Sucursal::where('id',$this->sucursal_id)->first()->nombre;




       foreach($this->prod as $p){
          
           
            $produc=ProductoSerialSucursal::where('id',$p)->first();


            $produc->update([
                'estado' => 'inactivo',
                'sucursal_id' => $this->sucursal,
            ]);

            $producto_traslado = new ProductosTraslado();
            $producto_traslado->producto_serial_sucursal_id = $p;
            $producto_traslado->sucursal_id = $this->sucursal_id;
            $producto_traslado->save();

            $traslado = new Traslado();
            $traslado->fecha = $fecha_actual;
            $traslado->observacion_inicial = 'Traslado desde almacen '. $sucursal_inicial .' hasta almacen '. $sucursal_final .', por usuario '. $user_auth_nombre .' '. $user_auth_apellido. ' Fecha del registro del tradado: '. $fecha_actual ;
            $traslado->producto_serial_sucursal_id = $p;
            $traslado->observacion_final = 'SIN RECIBIR EN SUCURSAL DESTINO';
            $traslado->estado = 'PENDIENTE';
            $traslado->save();

            $pivot_decrement = Pivot::where('sucursal_id',$this->sucursal)->where('producto_id',$produc->producto_id)->first(); 
            $pivot_decrement->cantidad = $pivot_decrement->cantidad - 1;
            $pivot_decrement->save();

            $cant++;
        }

        $this->resetPage();
        $this->emitTo('productos.productos-traslado','render');
        $this->emit('alert','Datos registrados correctamente');

    }



    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Seleccionar sucursal destino: Seleccione la sucursal destino en el select ubicado en la zona superior izquierda</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-. Seleccionar equipos por serial a trasladar: Haga click en el check cuadrado ubicado al lado de cada equipo.</p>
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-. Procesar traslado: Una vez haya seleccionado todos los equipos a trasladar haga click en el botón Procesar</p>');
    }
}
