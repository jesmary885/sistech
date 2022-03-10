<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario_auth = auth()->user();
        

            $fecha_actual = date('Y-m-d');
            $productos_cant = Producto::count();
            $clientes_cant = Cliente::count();

            $cantidad_ventas = DB::select('SELECT COUNT(*) as cantidad from ventas v
            where v.fecha = :fecha_actual AND v.estado = "activa"' 
            ,array('fecha_actual' => $fecha_actual));

            $total_ventas = DB::select('SELECT sum(v.total_pagado_cliente) as quantity from ventas v
            where v.fecha = :fecha_actual AND v.estado = "activa"'
            ,array('fecha_actual' => $fecha_actual));

            
            $ventas_dia=json_encode($cantidad_ventas);
            $ventas_dia_total=json_decode($ventas_dia);
    
            $total_vent=json_encode($total_ventas);
            $total_venta=json_decode($total_vent);


        $ventas_totales_dia=$ventas_dia_total[0]->cantidad;
        $total_ganancias_dia=$total_venta[0]->quantity;

       // $total_venta[0]->quantity;


            return view('home',compact('productos_cant','clientes_cant','ventas_totales_dia','total_ganancias_dia'));
    
        
    }
}
