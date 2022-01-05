<?php

namespace App\Http\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;

class ProductosCreate extends Component
{

    public $nombre, $serial, $cantidad, $inventario_min, $presentacion, $precio_entrada, $precio_letal, $precio_mayor, $percepcion, $tipo_garantia, $garantia, $estado, $file, $marcas, $categorias, $proveedores;
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

    public function save()
    {
        // $rules = $this->rules;
        // $this->validate($rules);

        return 'hola';

        // $producto = new Producto();
        // $producto->nombre = $this->nombre;
        // $producto->serial = $this->serial;
        // $producto->cantidad = $this->cantidad;
        // $producto->cod_barra = $this->cod_barra;
        // $producto->inventario_min = $this->inventario_min;
        // $producto->presentacion = $this->presentacion;
        // $producto->precio_entrada = $this->precio_entrada;
        // $producto->precio_letal = $this->precio_letal;
        // $producto->precio_mayor = $this->precio_mayor;
        // $producto->percepcion = $this->percepcion;
        // $producto->modelo_id = $this->modelo_id;
        // $producto->categoria_id = $this->categoria_id;
        // $producto->observaciones = $this->observaciones;
        // $producto->tipo_garantia = $this->tipo_garantia;
        // $producto->garantia = $this->garantia;
        // $producto->estado = $this->estado;
        // $producto->save();


        // return redirect()->route('admin.productos.index');

        // $this->reset(['nombre','apellido','cedula','division_id','negocio_id','region_id','email','telefono','indicador']);

        // $this->emitTo('user-index','render');
        // $this->emit('alert','Usuario registrado correctamente');
        
    }

    public function render()
    {
        return view('livewire.productos.productos-create');
    }
}
