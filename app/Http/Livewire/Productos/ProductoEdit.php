<?php

namespace App\Http\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Producto_sucursal as Pivot;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class ProductoEdit extends Component
{
    use WithFileUploads;
    public $isopen = false;
    public $pivot, $nombre, $p, $fecha_actual, $sucursal_nombre, $cantidad, $observaciones, $cod_barra, $inventario_min, $presentacion, $precio_entrada, $precio_letal, $precio_mayor, $tipo_garantia, $garantia, $estado, $file, $marcas, $categorias, $modelos, $proveedores, $sucursales,$producto;
    public $marca_id = "", $sucursal_id = "" ,$modelo_id = "", $categoria_id = "", $proveedor_id ="";
    public $limitacion_sucursal = true;

     // protected $rules = [
    //     'region_id' => 'required',
    //      'division_id' => 'required',
    //      'negocio_id' => 'required',
    //     'nombre' => 'required|max:50',
    //      'apellido' => 'required|max:50',
    //      'cedula' => 'required|numeric|min:7',
    //      'indicador' => 'required',
    //      'telefono' => 'required|numeric|min:11',
    //      'email' => 'required|max:50|unique:users',
    //  ];


    public function updatedMarcaId($value)
    {
        $marca_select = Marca::find($value);
        $this->modelos = $marca_select->modelos;
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'image|max:1024',
        ]);
    }
 

    public function mount($producto){
        $this->p = $producto;

         $usuario_au = User::where('id',Auth::id())->first();
         if($usuario_au->limitacion == '1'){
             $this->sucursales=Sucursal::all();
             $this->sucursal_id = '1';
         }else{
             $this->limitacion_sucursal = false;
             $this->sucursal_id = $usuario_au->sucursal_id;
             $sucursal_usuario = Sucursal::where('id',$this->sucursal_id)->first();
             $this->sucursal_nombre = $sucursal_usuario->nombre;
         }

         
        
         $this->nombre = $this->producto->nombre;
         $this->cod_barra = $this->producto->cod_barra;
         $this->precio_entrada = $this->producto->precio_entrada;
         $this->precio_letal = $this->producto->precio_letal;
         $this->precio_mayor = $this->producto->precio_mayor;
         $this->cantidad = $this->producto->sucursals->find($this->sucursal_id)->pivot->cantidad;
         $this->inventario_min = $this->producto->inventario_min;
         $this->modelo_id = $this->producto->modelo_id;
         $this->categoria_id = $this->producto->categoria_id;
         $this->tipo_garantia = $this->producto->tipo_garantia;
         $this->garantia = $this->producto->garantia;
        $this->marca_id = $this->producto->marca_id;
         $this->presentacion = $this->producto->presentacion;
         $this->observaciones = $this->producto->observaciones;
         $this->estado = $this->producto->estado;
         $this->modelos=Modelo::all();
         $this->marcas=Marca::all();
         $this->categorias=Categoria::all();
         $this->proveedores=Proveedor::all();
     }




    public function render()
    {
        return view('livewire.productos.producto-edit');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function update(){
        // $rules = $this->rules;
        // $this->validate($rules);

        $this->fecha_actual = date('Y-m-d');

        $usuario_auth = Auth::id();
        
        $this->pivot = Pivot::where('sucursal_id',$this->sucursal_id)
                            ->where('producto_id',$this->producto->id)
                            ->first();

        $this->producto->update([
            'nombre' => $this->nombre,
            'cod_barra' => $this->cod_barra,
            'precio_entrada' => $this->precio_entrada,
            'precio_letal' => $this->precio_letal,
            'precio_mayor' => $this->precio_mayor,
           // cantidad = $this->producto->sucursals->find($this->sucursal_id)->pivot->cantidad;
            'inventario_min' => $this->inventario_min,
            'modelo_id' => $this->modelo_id,
            'categoria_id' => $this->categoria_id,
            'tipo_garantia' => $this->tipo_garantia,
            'garantia' => $this->garantia,
            'marca_id' => $this->marca_id,
            'presentacion' => $this->presentacion,
            'observaciones' => $this->observaciones,
            'estado' => $this->estado
        ]);

    if ($this->file){
            $imagen = Imagen::where('imageable_id',$this->producto->id)->first();
            $url = Storage::put('public/productos', $this->file);
            if($imagen) $this->producto->imagen()->update(['url' => $url]);
            else $this->producto->imagen()->create(['url' => $url]);
         }

        $this->producto->movimientos()->create([
            'fecha' => $this->fecha_actual,
            'tipo_movimiento' => 'Modificación de información de producto',
            'cantidad' => $this->cantidad,
            'precio' => $this->precio_letal,
            'observacion' => 'Modificación de datos',
            'user_id' => $usuario_auth
        ]);

         $this->pivot->cantidad = $this->cantidad;
         $this->pivot->save();

        $this->reset(['isopen']);
       $this->emitTo('productos.productos-index','render');
        $this->emit('alert','Producto modificado correctamente');
    }
}
