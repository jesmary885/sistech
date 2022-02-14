<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentasViewController extends Controller
{
    public function index()
    {
        return view('ventas.view_ventas_clientes');
    }
}
