<?php

namespace App\Http\Livewire\Reportes;

use Livewire\Component;

class ReporteVenta extends Component
{
    public $fecha_inicio, $fecha_fin, $sucursal_id;
    
    public function render()
    {
        return view('livewire.reportes.reporte-venta');
    }
}
