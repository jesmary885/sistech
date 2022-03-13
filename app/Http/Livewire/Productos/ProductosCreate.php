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
use Illuminate\Support\Str;


class ProductosCreate extends Component
{

    use WithFileUploads;

    public $nombre, $puntos, $fecha_actual, $sucursal_nombre, $cantidad, $observaciones, $cod_barra, $inventario_min, $presentacion, $precio_entrada, $precio_letal, $precio_mayor, $tipo_garantia, $garantia, $estado, $file, $marcas, $categorias, $proveedores, $sucursales;
    public $modelos = [];
    public $marca_id = "", $sucursal_id = "" ,$modelo_id = "", $categoria_id = "", $proveedor_id ="";
    public $limitacion_sucursal = true;
    public $ff;

    protected $listeners = ['refreshimg'];

     protected $rules = [
         'nombre' => 'required|unique:productos',
         'cod_barra'=>'required|unique:productos|min:8|max:12',
         'precio_entrada' => 'required|numeric',
         'precio_letal' => 'required|numeric',
         'precio_mayor' => 'required|numeric',
         'cantidad' => 'required|numeric',
         'puntos' => 'required|numeric',
         'categoria_id' => 'required',
         'marca_id' => 'required',
         'modelo_id' => 'required',
         'proveedor_id' => 'required',
         'sucursal_id' => 'required',
         'estado' => 'required',
         'file' => 'max:1024',
      ];

      protected $rule_file = [
        'file' => 'image|max:1024',
     ];

 
    public function mount(){
 
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

        $rules = $this->rules;
        $this->validate($rules);

        $sucursales = Sucursal::all();

        $this->fecha_actual = date('Y-m-d');
        $usuario_auth = Auth::id();
        $total_compra = (round($this->precio_entrada,2)) * $this->cantidad;
        if($this->observaciones == '') $this->observaciones = 'Sin observaciones';

        if($this->precio_entrada < 0 || $this->precio_letal < 0 || $this->precio_mayor < 0 || $this->cantidad < 0 || $this->puntos < 0){
            $this->emit('errorSize','Ha ingresado un valor negativo, intentelo de nuevo');
        }
        else{
            //agregando producto en tabla productos
            $producto = new Producto();
            $producto->nombre = $this->nombre;
            if($this->cod_barra) $producto->cod_barra = $this->cod_barra;
            else $producto->cod_barra = Str::random(8);
            // $producto->presentacion = $this->presentacion;
            $producto->precio_entrada = $this->precio_entrada;
            $producto->precio_letal = $this->precio_letal;
            $producto->puntos = $this->puntos;
            $producto->precio_mayor = $this->precio_mayor;
            $producto->modelo_id = $this->modelo_id;
            $producto->marca_id = $this->marca_id;
    
            $producto->categoria_id = $this->categoria_id;
            $producto->observaciones = $this->observaciones;
            $producto->estado = $this->estado;
            $producto->save();
            //agregando imagen de producto en tabla imagenes

            if ($this->file){
                    $rule_file = $this->rule_file;
                    $this->validate($rule_file);
                    $url = Storage::put('public/productos', $this->file);
                    $producto->imagen()->create([
                        'url' => $url
                    ]);
                }

            //registrando compra en tabla compras
            $compra = new Compra();
            $compra->fecha = $this->fecha_actual;
            $compra->total = $total_compra;
            $compra->cantidad = $this->cantidad;
            $compra->precio_compra = $this->precio_entrada;
            $compra->proveedor_id = $this->proveedor_id;
            $compra->user_id = $usuario_auth;
            $compra->sucursal_id = $this->sucursal_id;
            $compra->producto_id = $producto->id;
            $compra->save();
            
            /*  $producto->compras()->create([
                'fecha' => $this->fecha_actual,
                'total' => $total_compra,
                'cantidad' => $this->cantidad,
                'precio_compra' => $this->precio_entrada,
                'proveedor_id' => $this->proveedor_id,
                'user_id' => $usuario_auth,
                'sucursal_id' => $this->sucursal_id
            ]);*/

            //agregando productos si contienen serial en tabla producto_cod_barra_serials
    
                for ($i=0; $i < $this->cantidad; $i++) {
                    $producto->productoSerialSucursals()->create([
                        'serial' => 'S/S',
                        'sucursal_id' => $this->sucursal_id,
                        'cod_barra' => $producto->cod_barra,
                        'compra_id' => $compra->id,
                        'modelo_id' => $this->modelo_id,
                        'marca_id' => $this->marca_id,
                        'estado' => 'activo',
                        'fecha_compra' => $compra->fecha
                    ]);
                }

            //registrando moviemientos en tabla movimientos
            $producto->movimientos()->create([
                'fecha' => $this->fecha_actual,
                'tipo_movimiento' => 'registro y compra de producto',
                'cantidad' => $this->cantidad,
                'precio' => $this->precio_letal,
                'observacion' => 'registro de producto',
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

            $this->reset(['nombre','puntos','cantidad','cod_barra','inventario_min','presentacion','precio_entrada','precio_letal','precio_mayor','modelo_id','categoria_id','observaciones','tipo_garantia','garantia','estado','proveedor_id','marca_id','file']);
            $this->emit('alert','Producto creado correctamente');
            $this->emitTo('productos.productos-index','render');
        }
    }


    public function render()
    {
        return view('livewire.productos.productos-create');
    }
}
