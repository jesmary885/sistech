<?php

namespace App\Http\Livewire\Admin\Modelos;

use App\Models\Modelo;
use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;

class ModeloIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search,$modelo;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $modelos = Modelo::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.admin.modelos.modelo-index',compact('modelos'));
    }
    public function delete($modeloId){
        $this->modelo = $modeloId;
        $busqueda = Producto::where('modelo_id',$modeloId)->first();

        if($busqueda) $this->emit('errorSize', 'Este modelo esta asociado a un producto, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este modelo?','admin.modelos.modelo-index','confirmacion','El modelo se ha eliminado.');
    }
    public function confirmacion(){
        $modelo_destroy = Modelo::where('id',$this->modelo)->first();
        $modelo_destroy->delete();
    }
}
