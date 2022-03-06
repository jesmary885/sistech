<?php

namespace App\Http\Livewire\Productos;

use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductoExport;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Producto_sucursal;
use Illuminate\Support\Facades\DB;
use App\Models\Producto_sucursal as Pivot;
use Illuminate\Database\Eloquent\Builder;


class ProductosExport extends Component
{
    use WithFileUploads;

    public $fecha_actual, $sucursal_nombre, $estado, $sucursales;
    public $sucursal_id = "";
    public $limitacion_sucursal = true;
    public $isopen = false;

    protected $rules = [
        'estado' => 'required',
        'sucursal_id' => 'required',
    ];

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

     }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function render()
    {
        return view('livewire.productos.productos-export');
    }

    public function export(){

        $rules = $this->rules;
        $this->validate($rules);
        
        if($this->estado == 1){
            if($this->sucursal_id == 0){
                $productos_sucursal = DB::select('SELECT p.nombre, p.cod_barra, p.precio_letal, p.precio_mayor,p.categoria_id,p.marca_id,p.modelo_id, p.observaciones, sum(ps.cantidad) as quantity from productos p 
                inner join producto_sucursal ps on p.id = ps.producto_id
                group by p.nombre, p.cod_barra, p.precio_letal, p.precio_mayor,p.categoria_id,p.marca_id,p.modelo_id, p.observaciones');
                $data=json_encode($productos_sucursal);
                $array = json_decode($data, true);
                for($i=0 ; $i<sizeof($array); $i++){
                    $array[$i]['categoria_id'] = Categoria::where('id',$array[$i]['categoria_id'])->first()->nombre;
                    $array[$i]['marca_id'] = Marca::where('id',$array[$i]['marca_id'])->first()->nombre;
                    $array[$i]['modelo_id'] = Modelo::where('id',$array[$i]['modelo_id'])->first()->nombre;
                }
                $relacion = 'sql';
                $sucursal = 0;
            }
            else{
                $productos_sucursal = Pivot::where('sucursal_id',$this->sucursal_id)->get();
                $array = $productos_sucursal;
                $relacion ='eloquent';
                $sucursal = 0;
            }
        }
        else{
            if($this->estado == 2) $estado = 1;
            elseif($this->estado == 3) $estado = 2;

            if($this->sucursal_id == 0){
               $productos_sucursal = DB::select('SELECT p.nombre, p.cod_barra, p.precio_letal, p.precio_mayor,p.categoria_id,p.marca_id,p.modelo_id, p.observaciones, sum(ps.cantidad) as quantity from productos p 
                inner join producto_sucursal ps on p.id = ps.producto_id where p.estado = :estado
                group by p.nombre, p.cod_barra, p.precio_letal, p.precio_mayor,p.categoria_id,p.marca_id,p.modelo_id, p.observaciones',array('estado' => $estado));
                $data=json_encode($productos_sucursal);
                $array = json_decode($data, true);

                for($i=0 ; $i<sizeof($array); $i++){
                    $array[$i]['categoria_id'] = Categoria::where('id',$array[$i]['categoria_id'])->first()->nombre;
                    $array[$i]['marca_id'] = Marca::where('id',$array[$i]['marca_id'])->first()->nombre;
                    $array[$i]['modelo_id'] = Modelo::where('id',$array[$i]['modelo_id'])->first()->nombre;
                }
                $relacion = 'sql';
                $sucursal = 0;
            }

            else{
                $productos_sucursal = Producto::where('estado',$estado)
                                            ->whereHas('sucursals',function(Builder $query) {
                                                $query->where('sucursal_id',$this->sucursal_id);
                                            })->get();

                $array = $productos_sucursal;
                $relacion ='eloquent';
                $sucursal = $this->sucursal_id;
            }
        }
        $this->reset(['isopen','estado','sucursal_id']);
        return Excel::download(new ProductoExport($array,$relacion,$sucursal), 'ReporteProductos.xlsx');

    }
}
