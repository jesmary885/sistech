<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MostrarVentasController extends Controller
{
    public function index()
    {
        $tipo = "contado";
        return view ('ventas.index',compact('tipo'));
    }

  
    public function create()
    {
        $tipo = "credito";
        return view ('ventas.index',compact('tipo'));
    }

    public function store(Request $request)
    {

       
    }

  
    public function show($tipo)
    {
       
    }

 
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
