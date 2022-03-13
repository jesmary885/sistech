<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductosSerialController extends Controller
{
    public function index()
    {
        $vista = 'productos_serial';
        $usuario_auth = User::where('id',Auth::id())->first();
        $sucursal = $usuario_auth->sucursal_id;

        if($usuario_auth->limitacion == '1')  return view('ventas.seleccion_sucursal',compact('vista'));
        else  return view('productos.serial_view',compact('sucursal'));

    }

    public function view($sucursal)
    {
        return view('productos.serial_view',compact('sucursal'));
    }

    
}
