<?php

namespace App\Http\Livewire\Productos;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\User;

use App\Models\Producto_sucursal as Pivot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductosAdd extends Component
{

    public $isopen = false;
    public $producto, $pivot, $precio_compra, $proveedores, $cantidad, $sucursal_nombre, $sucursal_id = "", $sucursales, $proveedor_id = "";
    public $limitacion_sucursal = true;
      
    protected $rules = [
        'cantidad' => 'required',
        'sucursal_id' => 'required',
        'precio_compra' => 'required',
        'proveedor_id' => 'required',
    ];

    public function mount(){
        $this->proveedores=Proveedor::all();
         $usuario_au = User::where('id',Auth::id())->first();
         if($usuario_au->limitacion == '1'){
             $this->sucursales=Sucursal::all();
         }else{
             $this->limitacion_sucursal = false;
             $this->sucursal_id = $usuario_au->sucursal_id;
             $sucursal_usuario = Sucursal::where('id',$this->sucursal_id)->first();
             $this->sucursal_nombre = $sucursal_usuario->nombre;
         }
     }
 
    public function render()
    {
        return view('livewire.productos.productos-add');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function save(){

        $sucursales = Sucursal::all();
        $producto_select = Producto::where('id',$this->producto->id)->first();
        $cantidad_nueva_general = $producto_select->cantidad + $this->cantidad;
        $this->fecha_actual = date('Y-m-d');
        $usuario_auth = Auth::id();
        $total_compra = ($this->precio_compra * $this->cantidad);

        $rules = $this->rules;
        $this->validate($rules);

        //modificando cantidad en tabla pivote producto_sucursal

        $cantidad_nueva_sucursal = $this->producto->sucursals->find($this->sucursal_id)->pivot->cantidad + $this->cantidad;
        $pivot = Pivot::where('sucursal_id',$this->sucursal_id)
                        ->where('producto_id',$producto_select->id)
                        ->first();
        $pivot->cantidad = $cantidad_nueva_sucursal;
        $pivot->save();
        
        //agregando compra
            $this->producto->compras()->create([
            'fecha' => $this->fecha_actual,
            'total' => $total_compra,
            'precio_compra' => $this->precio_compra,
            'cantidad' => $this->cantidad,
            'proveedor_id' => $this->proveedor_id,
            'sucursal_id' => $this->sucursal_id,
            'user_id' => $usuario_auth
        ]);

        //agregando productos si contienen serial en tabla producto_cod_barra_serials
        if($producto_select->serial == '1'){
            for ($i=0; $i < $this->cantidad; $i++) {
                $producto_select->producto_cod_barra_serials()->create([
                    'serial' => '',
                    'sucursal_id' => $this->sucursal_id
                ]);
            }
        }

          //registrando moviemientos en tabla movimientos
          $producto_select->movimientos()->create([
            'fecha' => $this->fecha_actual,
            'tipo_movimiento' => 'Agregando unidades a producto',
            'cantidad' => $this->cantidad,
            'precio' => $this->precio_compra,
            'observacion' => "Registro de unidades del producto". $producto_select->nombre,
            'user_id' => $usuario_auth
        ]);


        $this->reset(['isopen','precio_compra','sucursal_id','precio_compra','cantidad']);
        $this->emitTo('productos.productos-index','render');
        $this->emit('alert','Datos registrados correctamente');
    }
}
