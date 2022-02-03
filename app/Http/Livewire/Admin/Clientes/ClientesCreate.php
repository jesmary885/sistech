<?php

namespace App\Http\Livewire\Admin\Clientes;

use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\Estado;
use Livewire\Component;

class ClientesCreate extends Component
{

    public $estado_id ="",$ciudad_id ="";
    public $nombre, $apellido, $tipo_documento, $documento, $telefono, $email, $ciudades, $direccion, $client, $estados;
    public $isopen = false;
    public $vista, $accion, $cliente;
      
    protected $rules = [
        'estado_id' => 'required',
        'ciudad_id' => 'required',
        'nombre' => 'required|max:50',
        'apellido' => 'required|max:50',
        'direccion' => 'required|max:50',
        'documento' => 'required|numeric|min:5',
        'tipo_documento' => 'required',
        'telefono' => 'required|numeric|min:11',
        'email' => 'required|max:50'
    ];


    public function updatedCiudadId($value)
    {
        $ciudad_select = Ciudad::find($value);
        $this->estados = $ciudad_select->estados;
    }

    public function mount(Cliente $cliente){
        $this->cliente = $cliente;
        if($cliente){
            $this->tipo_documento = $this->cliente->tipo_documento;
            $this->documento = $this->cliente->nro_documento;
            $this->telefono = $this->cliente->telefono;
            $this->nombre = $this->cliente->nombre;
            $this->apellido = $this->cliente->apellido;
            $this->email = $this->cliente->email;
            $this->direccion = $this->cliente->direccion;
            $this->ciudad_id = $this->cliente->ciudad_id;
            $this->estado_id = $this->cliente->estado_id;
        }
        $this->ciudades=Ciudad::all();
        $this->estados=Estado::all();
    }


    public function render()
    {
        return view('livewire.admin.clientes.clientes-create');
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
            $rules = $this->rules;
            $this->validate($rules);

            if($this->accion == 'create')
            {
                $cliente = new Cliente();
                $cliente->nombre = $this->nombre;
                $cliente->apellido = $this->apellido;
                $cliente->email = $this->email;
                $cliente->nro_documento = $this->documento;
                $cliente->tipo_documento = $this->tipo_documento;
                $cliente->direccion= $this->direccion;
                $cliente->telefono = $this->telefono;
                $cliente->ciudad_id = $this->ciudad_id;
                $cliente->estado_id = $this->estado_id;
                $cliente->save();

                $this->reset(['nombre','apellido','email','telefono','documento','tipo_documento','direccion','ciudad_id','estado_id','isopen']);
                if ($this->vista == "ventas") $this->emitTo('ventas.venta-facturacion','render');
                else $this->emitTo('admin.clientes.clientes-index','render');

                $this->emit('alert','Cliente creado correctamente');
            }
            else
            {
                $this->cliente->update([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'email' => $this->email,
                    'nro_documento' => $this->documento,
                    'tipo_documento' => $this->tipo_documento,
                    'direccion' => $this->direccion,
                    'telefono' => $this->telefono,
                    'ciudad_id' => $this->ciudad_id,
                    'estado_id' => $this->estado_id,
                ]);
                $this->reset(['isopen']);
                $this->emitTo('admin.clientes.clientes-index','render');
                $this->emit('alert','Datos modificados correctamente');
            }
    }

}
