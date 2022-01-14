<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Sucursal;
use Livewire\Component;

class VentasSeleccionSucursal extends Component
{
    public function render()
    {

        $sucursales = Sucursal::all();

        return view('livewire.ventas.ventas-seleccion-sucursal',compact('sucursales'));
    }
}
