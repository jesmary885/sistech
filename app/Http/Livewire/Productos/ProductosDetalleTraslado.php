<?php

namespace App\Http\Livewire\Productos;

use App\Models\Movimiento;
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
        $cont = 0;
        $fecha_actual = date('Y-m-d');
        $user_auth =  auth()->user()->id;


       foreach($this->prod as $p){
            $produc=ProductoSerialSucursal::where('id',$p[0])->first();
            $produc->update([
                'sucursal_id' => $this->sucursal_id
            ]);
            $cont++;
        }

        $pivot_increment = Pivot::where('sucursal_id',$this->sucursal_id)->where('producto_id',$this->producto->id)->first();
        $pivot_decrement = Pivot::where('sucursal_id',$this->sucursal)->where('producto_id',$this->producto->id)->first(); 

    
        $pivot_increment->cantidad = $pivot_increment->cantidad + $cont;
        $pivot_decrement->cantidad = $pivot_decrement->cantidad - $cont;

        $pivot_increment->save();
        $pivot_decrement->save();

        $sucursal_inicial = Sucursal::where('id',$this->sucursal)->first()->nombre;
        $sucursal_final = Sucursal::where('id',$this->sucursal_id)->first()->nombre;

        $movimiento = new Movimiento();
            $movimiento->fecha = $fecha_actual;
            $movimiento->tipo_movimiento = 'Traslado';
            $movimiento->cantidad = $cont;
            $movimiento->precio = $this->producto->precio_letal;
            $movimiento->observacion = 'Traslado desde almacen '. $sucursal_inicial .' hasta almacen '. $sucursal_final;
            $movimiento->producto_id = $this->producto->id;
            $movimiento->user_id = $user_auth;
            $movimiento->save();

            $this->emitTo('productos.productos-traslado','render');
            $this->emit('alert','Datos registrados correctamente');
        
        
    }
}
