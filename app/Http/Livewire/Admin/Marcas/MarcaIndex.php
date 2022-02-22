<?php

namespace App\Http\Livewire\Admin\Marcas;

use App\Models\Marca;
use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;

class MarcaIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search,$categoria;

    public function updatingSearch(){
        $this->resetPage();
    }


    public function render()
    {
        $marcas = Marca::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.admin.marcas.marca-index',compact('marcas'));
    }

    public function delete($marcaId){
        $this->marca = $marcaId;
        $busqueda = Producto::where('marca_id',$marcaId)->first();

        if($busqueda) $this->emit('errorSize', 'Esta marca esta asociada a un producto, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar esta marca?','admin.marcas.marca-index','confirmacion','La marca se ha eliminado.');
    }
    public function confirmacion(){
        $marca_destroy = Marca::where('id',$this->marca)->first();
        $marca_destroy->delete();
    }

}
