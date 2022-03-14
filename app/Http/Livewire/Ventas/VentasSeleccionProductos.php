<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Modelo;
use App\Models\Producto;
use App\Models\ProductoSerialSucursal;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
Use Livewire\WithPagination;


class VentasSeleccionProductos extends Component
{

    public $search, $sucursal,$pivot,$buscador,$modalidad_busqueda,$tipo,$proforma;

    //protected $listeners = ['render' => 'render'];


    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){
        //$this->buscador = "1";
    }


    public function render()
    {
        $sucursal = $this->sucursal;

        $sucursales = Sucursal::all();

        $proforma = $this->proforma;

       
        if($this->buscador == '1'){
            $this->tipo = 0;
            $productos = ProductoSerialSucursal::where('serial', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo')
            ->paginate(5);
        }
        elseif($this->buscador == '2'){
            $productos = ProductoSerialSucursal::whereHas('marca',function(Builder $query){
                $query->where('nombre','LIKE', '%' . $this->search . '%')
                ->where('sucursal_id',$this->sucursal)
                ->where('estado','activo');
             })->paginate(5);
        }

        elseif($this->buscador == '3'){
             $productos = ProductoSerialSucursal::whereHas('modelo',function(Builder $query){
                $query->where('nombre','LIKE', '%' . $this->search . '%')
                ->where('sucursal_id',$this->sucursal)
                ->where('estado','activo');
             })->paginate(5);
        }
       
        else{
            $productos = ProductoSerialSucursal::where('cod_barra', 'LIKE', '%' . $this->search . '%')
            ->where('sucursal_id',$this->sucursal)
            ->where('estado','activo')
            ->paginate(5);
        }

        return view('livewire.ventas.ventas-seleccion-productos',compact('productos','sucursal','sucursales','proforma'));
    }

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">1-. Agregar equipos a la venta: Haga click en el botón " <i class="fas fa-check"></i> ", ubicado al lado de cada producto y en el formulario seleccione el tipo de precio que utilizara en la venta (Precio letal o al mayor) y haga click en el boton "Agregar a la venta".</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">2-. Si selecciona el mismo producto dos veces el sistema le informará que ya el producto esta registrado en la venta e ignorará su petición</p> 
        <p class="text-sm text-gray-500 m-0 p-0 text-justify">3-.Si ya ha seleccionado todos los productos haga click en el boton " Continuar>>".</p>');
    }
}
