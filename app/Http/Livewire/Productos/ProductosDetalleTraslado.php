<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento;
use App\Models\Movimiento_product_serial;
use App\Models\Producto;
use App\Models\Sucursal;
use Livewire\Component;
use App\Models\Producto_sucursal as Pivot;
use App\Models\ProductoSerialSucursal;
use Livewire\WithPagination;

class ProductosDetalleTraslado extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $isopen = false;
    public $sucursal, $cantidad, $sucursal_id = "", $sucursales, $producto,$prod;
    
    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
          
    protected $rules = [

        'sucursal_id' => 'required',
    ];

    public function mount(Producto $producto,$sucursal){
        $this->producto = $producto;
        $this->sucursal = $sucursal;
             $this->sucursales=Sucursal::where('id','!=',$this->sucursal)->get();
     }
    public function render()
    {
        $productos = ProductoSerialSucursal::where('serial', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('cod_barra',$this->producto->cod_barra)
            ->paginate(5);

        return view('livewire.productos.productos-detalle-traslado',compact('productos'));
    }

    public  function save()
    {
       
        $rules = $this->rules;
        $this->validate($rules);
        $cant = 0;
        $fecha_actual = date('Y-m-d');
        $user_auth =  auth()->user()->id;
        
        $sucursal_inicial = Sucursal::where('id',$this->sucursal)->first()->nombre;
        $sucursal_final = Sucursal::where('id',$this->sucursal_id)->first()->nombre;


       foreach($this->prod as $p){
            $movimiento_serial = new Movimiento_product_serial();
            $produc=ProductoSerialSucursal::where('id',$p)->first();
            $produc->update([
                'sucursal_id' => $this->sucursal_id
            ]);
          
            $movimiento_serial->fecha = $fecha_actual;
            $movimiento_serial->tipo_movimiento = 'Traslado';
            $movimiento_serial->precio = $this->producto->precio_letal;
            $movimiento_serial->observacion = 'Traslado desde almacen '. $sucursal_inicial .' hasta almacen '. $sucursal_final;
            $movimiento_serial->producto_serial_sucursal_id = $p;
            $movimiento_serial->user_id = $user_auth;
            $movimiento_serial->save();

            $cant++;
        }

        $pivot_increment = Pivot::where('sucursal_id',$this->sucursal_id)->where('producto_id',$this->producto->id)->first();
        $pivot_decrement = Pivot::where('sucursal_id',$this->sucursal)->where('producto_id',$this->producto->id)->first(); 

        $pivot_increment->cantidad = $pivot_increment->cantidad + $cant;
        $pivot_decrement->cantidad = $pivot_decrement->cantidad - $cant;

        $pivot_increment->save();
        $pivot_decrement->save();


        $movimiento = new Movimiento();
        $movimiento->fecha = $fecha_actual;
        $movimiento->tipo_movimiento = 'Traslado';
        $movimiento->cantidad = $cant;
        $movimiento->precio = $this->producto->precio_letal;
        $movimiento->observacion = 'Traslado desde almacen '. $sucursal_inicial .' hasta almacen '. $sucursal_final;
        $movimiento->producto_id = $this->producto->id;
        $movimiento->user_id = $user_auth;
        $movimiento->save();

        $this->emitTo('productos.productos-traslado','render');
        $this->emit('alert','Datos registrados correctamente');

    }
}
