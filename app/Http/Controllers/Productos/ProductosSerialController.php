<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductosSerialController extends Controller
{
    public function index()
    {
        $vista = 'productos_serial';
        return view('ventas.seleccion_sucursal',compact('vista'));
    }

    public function view($sucursal)
    {
        return view('productos.serial_view',compact('sucursal'));
    }

    
}
