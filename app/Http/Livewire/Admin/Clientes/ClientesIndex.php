<?php

namespace App\Http\Livewire\Admin\Clientes;

use App\Models\Cliente;
use App\Models\Venta;
use Livewire\Component;
Use Livewire\WithPagination;

class ClientesIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search,$cliente;

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

    public function delete($clienteId){
        $this->cliente = $clienteId;
        $busqueda = Venta::where('cliente_id',$clienteId)->first();

        if($busqueda) $this->emit('errorSize', 'Este cliente esta asociado a una venta, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este cliente?','admin.clientes.clientes-index','confirmacion','El cliente se ha eliminado.');
    }

    public function confirmacion(){
        $cliente_destroy = Cliente::where('id',$this->cliente)->first();
        $cliente_destroy->delete();
    }
}
