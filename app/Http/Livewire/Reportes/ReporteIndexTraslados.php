<?php

namespace App\Http\Livewire\Reportes;

use Carbon\Carbon;
use Livewire\Component;

class ReporteIndexTraslados extends Component
{
    public $fecha_inicio, $fecha_fin;

    protected $rules = [
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',

     ];


    public function render()
    {
        return view('livewire.reportes.reporte-index-traslados');
    }

   
    public function buscar(){

        $rules = $this->rules;
        $this->validate($rules);
        
        $fecha_inicio = Carbon::parse($this->fecha_inicio);
        $fecha_fin = Carbon::parse($this->fecha_fin);

        return redirect()->route('traslados.reportes',compact('fecha_inicio','fecha_fin'));
       
    }
}
