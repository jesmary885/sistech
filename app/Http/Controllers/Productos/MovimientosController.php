<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    public function index()
    {

        $vista = 'productos';
        return view('ventas.seleccion_sucursal',compact('vista'));
    }

    public function select_modalidad()
    {
        return view('productos.movimientos');
    }

    public function buscar(Request $request)
    {

        $request->validate([
            'modalidad' => 'required'
        ]);

        //$tiporeporte = $request["categoria"];

        if($request["modalidad"]==1){
            return redirect()->route('movimientos.historial');
        }
        if($request["modalidad"]==2){
            return redirect()->route('movimientos.historial_prod_serial');
        }
    
    }

    //historial
    
    public function historial()
    {
        return view('productos.historial');
    }

    public function historial_prod_serial()
    {
        return view('productos.historial_prod_serial');
    }

    public function historial_detalle($vista,$producto,$fecha_inicio,$fecha_fin)
    {
        return view('productos.historial_detalle',compact('vista','producto','fecha_inicio','fecha_fin'));
    }

    //Devolución 

    public function devolucion()
    {
        return view('productos.devolucion');
    }

    public function devolucion_create()
    {
        return view('productos.devolucion_create');
    }

   

    //Traslado

    public function select($sucursal)
    {
        return view('productos.traslado',compact('sucursal'));
    }

    public function select_serial($sucursal,$producto)
    {
        return view('productos.traslado_select_serial',compact('sucursal','producto'));
    }

    
}
