<?php

namespace App\Http\Livewire\Admin\Sucursales;

use App\Models\Producto_sucursal;
use App\Models\Sucursal;
use Livewire\Component;
Use Livewire\WithPagination;

class SucursalIndex extends Component
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

        $sucursales = Sucursal::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);

        return view('livewire.admin.sucursales.sucursal-index',compact('sucursales'));
    }

    
    public function delete($sucursalId){
        $this->sucursal = $sucursalId;
        $busqueda = Producto_sucursal::where('sucursal_id',$sucursalId)->first();

        if($busqueda) $this->emit('errorSize', 'Esta sucursal esta asociada a un producto, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar esta susucrsal?','admin.sucursales.sucursal-index','confirmacion','La sucursal se ha eliminado.');
    }
    public function confirmacion(){
        $sucursal_destroy = Sucursal::where('id',$this->sucursal)->first();
        $sucursal_destroy->delete();
    }
}
