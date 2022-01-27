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
    public $vista;
      
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

    public function mount(){
        // $this->tipo_documento = $this->client->tipo_documento;
        // $this->documento = $this->client->nro_documento;
        // $this->telefono = $this->client->telefono;
        // $this->nombre = $this->client->nombre;
        // $this->apellido = $this->client->apellido;
        // $this->email = $this->client->email;
        // $this->direccion = $this->client->direccion;
        // $this->ciudad_id = $this->client->ciudad_id;
        // $this->estado_id = $this->client->estado_id;
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

    /*public function update(){
        $rules = $this->rules;
        $this->validate($rules);
 
        if($this->password == $this->password_confirm){
            $this->usuario->update([
                'name' => $this->name,
                'email' => $this->email,
                'apellido' => $this->apellido,
                'nro_documento' => $this->documento,
                'tipo_documento' => $this->tipo_documento,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'password' => Hash::make($this->password),
                'password_encriptada' => Crypt::encryptString($this->password),
                'ciudad_id' => $this->ciudad_id,
                'estado_id' => $this->estado_id,
                'sucursal_id' => $this->sucursales_id,
                'limitacion' => $this->limitacion
            ]);
            $this->usuario->roles()->sync($this->roles_id);

            $this->reset(['isopen']);
            $this->emitTo('admin.usuarios-index','render');
            $this->emit('alert','Los datos han sido modificados correctamente');
        } else{
            $rul_password_conf = $this->rul_password_confirm;
            $this->validate($rul_password_conf);
        }
    }*/

    public function save(){
        $rules = $this->rules;
        $this->validate($rules);

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
            if($this->vista == "ventas") $this->emitTo('ventas.venta-facturacion','render');
            else
           $this->emitTo('admin.clientes.clientes-index','render');
            $this->emit('alert','Cliente creado correctamente');
    }

}
