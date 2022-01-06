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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;


class ProductosCreate extends Component
{

    use WithFileUploads;

    public $nombre, $fecha_actual, $serial, $cantidad, $observaciones, $cod_barra, $inventario_min, $presentacion, $precio_entrada, $precio_letal, $precio_mayor, $percepcion, $tipo_garantia, $garantia, $estado, $file, $marcas, $categorias, $proveedores;
    public $modelos = [];
    public $marca_id = "", $modelo_id = "", $categoria_id = "", $proveedor_id ="";


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

        $this->fecha_actual = date('Y-m-d');
        $usuario_auth = Auth::id();
        $total_compra = ($this->precio_entrada * $this->cantidad);

        $movimientos = new Movimiento();
        $producto_sucursal = new Producto_sucursal();
        $compras = new Compra();
        $producto = new Producto();
        
        $producto->nombre = $this->nombre;
        $producto->serial = $this->serial;
        $producto->cantidad = $this->cantidad;
        $producto->cod_barra = $this->cod_barra;
        $producto->inventario_min = $this->inventario_min;
        $producto->presentacion = $this->presentacion;
        $producto->precio_entrada = $this->precio_entrada;
        $producto->precio_letal = $this->precio_letal;
        $producto->precio_mayor = $this->precio_mayor;
        $producto->percepcion = $this->percepcion;
        $producto->modelo_id = $this->modelo_id;
        $producto->categoria_id = $this->categoria_id;
        $producto->observaciones = $this->observaciones;
        $producto->tipo_garantia = $this->tipo_garantia;
        $producto->garantia = $this->garantia;
        $producto->estado = $this->estado;
        $producto->save();

        if ($this->file){

            $producto->imagen()->create([
                'url' => $this->file
            ]);
    
        }
      
        if($this->serial == '1'){
            $producto_con_serial = new Producto_cod_barra_serial();
            for ($i=0; $i < $this->cantidad; $i++) {
                $producto_con_serial->serial = '';
                $producto_con_serial->producto_id = $producto->id;
                $$producto_con_serial->sucursal_id = '1';
                $producto_con_serial->save();
            }
        }

        $movimientos->fecha = $this->fecha_actual;
        $movimientos->tipo_movimiento = 'registro y compra de producto';
        $movimientos->cantidad = $this->cantidad;
        $movimientos->precio = $this->precio_letal;
        $movimientos->observacion = 'registro de producto';
        $movimientos->producto_id = $producto ->id;
        $movimientos->user_id = $usuario_auth;
        $movimientos->save();
        
        $producto_sucursal->producto_id = $producto->id;
        $producto_sucursal->sucursal_id = '1';
        $producto_sucursal->cantidad = $this->cantidad;
        $producto_sucursal->save();

        $compras->fecha = $this->fecha_actual;
        $compras->total= $total_compra;
        $compras->cantidad = $this->cantidad;
        $compras->proveedor_id = $this->proveedor_id;
        $compras->producto_id = $producto->id;
        $compras->user_id = $usuario_auth;
        $compras->save();

        $this->reset(['nombre','serial','cantidad','cod_barra','inventario_min','presentacion','precio_entrada','precio_letal','precio_mayor','percepcion','modelo_id','categoria_id','observaciones','tipo_garantia','garantia','estado','proveedor_id','file','marca_id']);
        $this->emit('alert');
        
    }

    public function render()
    {
        return view('livewire.productos.productos-create');
    }
}
