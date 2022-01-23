<?php

namespace App\Http\Livewire\Admin\Clientes;

use App\Models\Cliente;
use Livewire\Component;
Use Livewire\WithPagination;

class ClientesIndex extends Component
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

        $clientes = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orwhere('nro_documento', 'LIKE', '%' . $this->search . '%')
                    ->latest('id')
                    ->paginate(5);

        return view('livewire.admin.clientes.clientes-index',compact('clientes'));
    }
}
