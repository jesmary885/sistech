<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Queue\Listener;
Use Livewire\WithPagination;

use Livewire\Component;

class UsuariosIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {

        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                    ->orwhere('email', 'LIKE', '%' . $this->search . '%')
                    ->paginate();
        return view('livewire.admin.usuarios-index',compact('users'));
    }
}
