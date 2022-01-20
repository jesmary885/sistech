<?php

namespace App\Http\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Producto_cod_barra_serial;
use App\Models\Producto_sucursal;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;


class ProductosCreate extends Component
{

    use WithFileUploads;

    public $nombre, $fecha_actual, $sucursal_nombre, $cantidad, $observaciones, $cod_barra, $inventario_min, $presentacion, $precio_entrada, $precio_letal, $precio_mayor, $tipo_garantia, $garantia, $estado, $file, $marcas, $categorias, $proveedores, $sucursales;
    public $modelos = [];
    public $marca_id = "", $sucursal_id = "" ,$modelo_id = "", $categoria_id = "", $proveedor_id ="";
    public $limitacion_sucursal = true;

    // protected $rules = [
    //     'region_id' => 'required',
    //     'division_id' => 'required',
    //     'negocio_id' => 'required',
    //     'nombre' => 'required|max:50',
    //     'apellido' => 'required|max:50',
    //     'cedula' => 'required|numeric|min:7',
    //     'indicador' => 'required',
    //     'telefono' => 'required|numeric|min:11',
    //     'email' => 'required|max:50|unique:users',
    // ];

 
    public function mount(){
       // $usuario_auth = Auth::id();
        $usuario_au = User::where('id',Auth::id())->first();
        if($usuario_au->limitacion == '1'){
            $this->sucursales=Sucursal::all();
        }else{
            $this->limitacion_sucursal = false;
            $this->sucursal_id = $usuario_au->sucursal_id;
            $sucursal_usuario = Sucursal::where('id',$this->sucursal_id)->first();
            $this->sucursal_nombre = $sucursal_usuario->nombre;
        }
        $this->marcas=Marca::all();
        $this->categorias=Categoria::all();
        $this->proveedores=Proveedor::all();
    }

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

    public function save()
    {
        // $rules = $this->rules;
        // $this->validate($rules);

        $sucursales = Sucursal::all();

        $this->fecha_actual = date('Y-m-d');
        $usuario_auth = Auth::id();
        $total_compra = ($this->precio_entrada * $this->cantidad);

        //agregando producto en tabla productos
        $producto = new Producto();
        $producto->nombre = $this->nombre;
        $producto->cantidad = $this->cantidad;
        $producto->cod_barra = $this->cod_barra;
        $producto->inventario_min = $this->inventario_min;
        $producto->presentacion = $this->presentacion;
        $producto->precio_entrada = $this->precio_entrada;
        $producto->precio_letal = $this->precio_letal;
        $producto->precio_mayor = $this->precio_mayor;
        $producto->modelo_id = $this->modelo_id;
        $producto->categoria_id = $this->categoria_id;
        $producto->observaciones = $this->observaciones;
        $producto->tipo_garantia = $this->tipo_garantia;
        $producto->garantia = $this->garantia;
        $producto->estado = $this->estado;
        $producto->save();
        //agregando imagen de producto en tabla imagenes
        if ($this->file){
            $url = Storage::put('public/productos', $this->file);
            $producto->imagen()->create([
                'url' => $url
            ]);
        }
        //agregando productos si contienen serial en tabla producto_cod_barra_serials
        // if($this->serial == '1'){
        //     for ($i=0; $i < $this->cantidad; $i++) {
        //         $producto->producto_cod_barra_serials()->create([
        //             'serial' => '',
        //             'sucursal_id' => $this->sucursal_id
        //         ]);
        //     }
        // }

        //registrando moviemientos en tabla movimientos
        $producto->movimientos()->create([
            'fecha' => $this->fecha_actual,
            'tipo_movimiento' => 'registro y compra de producto',
            'cantidad' => $this->cantidad,
            'precio' => $this->precio_letal,
            'observacion' => 'registro de producto',
            'user_id' => $usuario_auth
        ]);

        //registrando compra en tabla compras
        $producto->compras()->create([
            'fecha' => $this->fecha_actual,
            'total' => $total_compra,
            'cantidad' => $this->cantidad,
            'proveedor_id' => $this->proveedor_id,
            'user_id' => $usuario_auth
        ]);

        //guardando cantidades en tabla pivote entre sucursal y productos
        foreach($sucursales as $sucursal){
            if($sucursal->id == $this->sucursal_id){
                $producto->sucursals()->attach([
                    $this->sucursal_id => [
                        'cantidad' => $this->cantidad
                    ]
                ]);
            }else{
                $producto->sucursals()->attach([
                    $sucursal->id => [
                        'cantidad' => 0
                    ]
                ]);
            }
        }
        
        $this->reset(['nombre','cantidad','cod_barra','inventario_min','presentacion','precio_entrada','precio_letal','precio_mayor','modelo_id','categoria_id','observaciones','tipo_garantia','garantia','estado','proveedor_id','file','marca_id']);
        $this->emit('alert','Producto creado correctamente');
    }
    public function render()
    {
        return view('livewire.productos.productos-create');
    }
}
