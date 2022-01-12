<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;

class UsuariosEdit extends Component
{

    public $estado_id ="",$ciudad_id ="", $roles_id, $sucursales_id = "";
    public $estados, $usuario;
    public $name, $apellido, $sucursales, $limitacion, $roles, $tipo_documento, $documento, $telefono, $email, $ciudades, $estado, $password, $direccion, $password_confirm;

    public $isopen = false;

      
    protected $rules = [
        'estado_id' => 'required',
        'ciudad_id' => 'required',
        'estado' => 'required',
        'name' => 'required|max:50',
        'apellido' => 'required|max:50',
        'direccion' => 'required|max:50',
        'documento' => 'required|numeric|min:5',
        'tipo_documento' => 'required',
        'roles_id' => 'required',
        'telefono' => 'required|numeric|min:11',
        'email' => 'required|max:50',
        'password' => 'required',
        'sucursales_id' => 'required',
        'limitacion' => 'required',
    ];

    protected $rul_password_confirm = [
        'password' => 'required|confirmed',
    ];

    public function updatedCiudadId($value)
    {
        $ciudad_select = Ciudad::find($value);
        $this->estados = $ciudad_select->estados;
    }

    public function mount(){
        $this->tipo_documento = $this->usuario->tipo_documento;
        $this->documento = $this->usuario->nro_documento;
        $this->telefono = $this->usuario->telefono;
        $this->name = $this->usuario->name;
        $this->apellido = $this->usuario->apellido;
        $this->email = $this->usuario->email;
        $this->direccion = $this->usuario->direccion;
        $this->ciudad_id = $this->usuario->ciudad_id;
        $this->estado_id = $this->usuario->estado_id;
        $this->password = Crypt::decryptString($this->usuario->password_cifrada);
        $this->password_confirm = $this->password;
        $this->estado = $this->usuario->estado;
        $this->limitacion = $this->usuario->limitacion;
        $this->sucursales_id = $this->usuario->sucursal_id;
        $this->roles_id = $this->usuario->roles->first()->id;
        $this->ciudades=Ciudad::all();
        $this->estados=Estado::all();
        $this->roles=Role::all();
        $this->sucursales=Sucursal::all();
    }

    public function render()
    {
        return view('livewire.admin.usuarios-edit');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function update(){
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
    }
}
