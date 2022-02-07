<?php

namespace App\Http\Livewire\Admin\Proveedores;

use App\Models\Compra;
use App\Models\Proveedor;
use Livewire\Component;
Use Livewire\WithPagination;

class ProveedorIndex extends Component
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
        $proveedores = Proveedor::where('nombre_proveedor', 'LIKE', '%' . $this->search . '%')
        ->orwhere('nro_documento', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.admin.proveedores.proveedor-index',compact('proveedores'));
    }

    public function delete($proveedorId){
        $this->proveedor = $proveedorId;
        $busqueda = Compra::where('proveedor_id',$proveedorId)->first();

        if($busqueda) $this->emit('errorSize', 'Este proveedor esta asociado a una compra, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este proveedor?','admin.proveedores.proveedor-index','confirmacion','El proveedor se ha eliminado.');
    }
    public function confirmacion(){
        $proveedor_destroy = Proveedor::where('id',$this->proveedor)->first();
        $proveedor_destroy->delete();
    }
}
