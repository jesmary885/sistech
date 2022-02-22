<?php

namespace App\Http\Livewire\Admin\Categorias;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;
Use Livewire\WithPagination;

class CategoriaIndex extends Component
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
        $categorias = Categoria::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.admin.categorias.categoria-index',compact('categorias'));
    }

    public function delete($categoriaId){
        $this->categoria = $categoriaId;
        $busqueda = Producto::where('categoria_id',$categoriaId)->first();

        if($busqueda) $this->emit('errorSize', 'Esta categoria esta asociada a un producto, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar esta categoria?','admin.categorias.categoria-index','confirmacion','La categoria se ha eliminado.');
    }
    public function confirmacion(){
        $categoria_destroy = Categoria::where('id',$this->categoria)->first();
        $categoria_destroy->delete();
    }
}
