<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosCreate extends Component
{
    use WithPagination;
 
    public function render()
    {

      
        return view('livewire.admin.usuarios-create');
    }
}
