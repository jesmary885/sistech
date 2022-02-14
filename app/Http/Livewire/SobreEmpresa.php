<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;

class SobreEmpresa extends Component
{

    public $empresa,$nombre, $tipo_documento, $documento, $telefono, $email, $direccion, $tipo_impuesto, $impuesto;


    protected $rules = [
        'nombre_impuesto' => 'required',
        'impuesto' => 'required',
        'nombre' => 'required|max:50',
        'direccion' => 'required',
        'documento' => 'required|numeric|min:5',
        'tipo_documento' => 'required',
        'telefono' => 'required|numeric|min:11',
        'email' => 'required|max:50',
    ];

    public function mount(){
        $this->empresa = Empresa::first();

        $this->tipo_documento = $this->empresa->tipo_documento;
        $this->documento = $this->empresa->nro_documento;
        $this->telefono = $this->empresa->telefono;
        $this->nombre = $this->empresa->nombre;
        $this->email = $this->empresa->email;
        $this->nombre_impuesto = $this->empresa->nombre_impuesto;
        $this->impuesto = $this->empresa->impuesto;
        $this->direccion = $this->empresa->direccion;
    }


    public function render()
    {
        return view('livewire.sobre-empresa');
    }

    public function update(){
        $rules = $this->rules;
        $this->validate($rules);
 
        
            $this->empresa->update([
                'nombre' => $this->nombre,
                'email' => $this->email,
                'nro_documento' => $this->documento,
                'tipo_documento' => $this->tipo_documento,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'impuesto' => $this->impuesto,
                'nombre_impuesto' => $this->nombre_impuesto,
               
            ]);
   
            $this->emit('alert','Los datos han sido modificados correctamente');
       
    }
}
