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

    public function historial()
    {
        return view('productos.historial');
    }

    public function devolucion()
    {
        return view('productos.devolucion');
    }

    public function devolucion_create()
    {
        return view('productos.devolucion_create');
    }

    public function historial_detalle($producto,$fecha_inicio,$fecha_fin)
    {
        return view('productos.historial_detalle',compact('producto','fecha_inicio','fecha_fin'));
    }

    public function select($sucursal)
    {
        return view('productos.traslado',compact('sucursal'));
    }

    
}
