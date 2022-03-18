<?php

namespace App\Http\Livewire\Productos;

use App\Exports\KardexExport;
use App\Models\Movimiento;
use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductosHistorial extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search, $fecha_inicio, $fecha_fin, $movimientos_totales;

    public function render()
    {
        $fecha_inicioo = date("Y-m-d",strtotime($this->fecha_inicio));
        $fecha_finn = date("Y-m-d",strtotime($this->fecha_fin));

        $productos=Producto::all();


            $movimientos = DB::select('SELECT p.cod_barra, p.nombre, p.id, p.categoria_id, p.modelo_id, p.marca_id, mc.nombre as marca_nombre, md.nombre as modelo_nombre, c.nombre as categoria_nombre, sum(m.precio_entrada) as precie_entrada, sum(m.precio_salida) as precie_salida, sum(m.cantidad_entrada) as quantity_entrada , sum(m.cantidad_salida) as quantity_salida from productos p
            right join categorias c on p.categoria_id = c.id
            right join modelos md on p.modelo_id = md.id
            right join marcas mc on p.marca_id = mc.id
            inner join movimientos m on p.id=m.producto_id where m.fecha BETWEEN :fecha_inicioo AND :fecha_finn
            group by p.cod_barra, p.nombre, p.id, p.categoria_id, p.modelo_id, p.marca_id, c.nombre, md.nombre, mc.nombre',array('fecha_inicioo' => $fecha_inicioo,'fecha_finn' => $fecha_finn));
       

            $data=json_encode($movimientos);
            $array = json_decode($data, true);

            $this->movimientos_totales = $array;



        return view('livewire.productos.productos-historial',compact('array'));
    }

    public function export(){

        
        $fecha_inicio = date("d-m-Y",strtotime($this->fecha_inicio));
        $fecha_fin = date("d-m-Y",strtotime($this->fecha_fin));
        $movimientos_totales = $this->movimientos_totales;


       // dd($movimientos_totales);

        return Excel::download(new KardexExport($movimientos_totales,$fecha_inicio,$fecha_fin), 'Kardex.xlsx');


    }

    


    

    public function ayuda(){
        $this->emit('ayuda','<p class="text-sm text-gray-500 m-0 p-0 text-justify">Para generar el reporte de los movimientos del equipo, ingrese el periodo de fechas en que desee generar el reporte y haga click al boton "<i class="fas fa-check"></i>" ubicado al lado del equipo que desea seleccionar');
    }
    
}
