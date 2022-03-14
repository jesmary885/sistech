<?php

namespace App\Http\Livewire\MovimientosCaja;

use App\Models\Sucursal;
use Livewire\Component;

class MovimientoNew extends Component
{

    public $sucursales, $sucursal, $tipo_movimiento, $cantidad, $observaciones, $sucursal_id = "";
    public $isopen = false;

      
    protected $rules = [
        'tipo_movimiento' => 'required',
        'cantidad' => 'required',
        'observaciones' => 'required',
    ];

    public function mount(){
 
             $this->sucursales=Sucursal::where('id','!=',$this->sucursal)->get();
     }

    public function render()
    {
        return view('livewire.movimientos-caja.movimiento-new');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function save(){

    }
}
