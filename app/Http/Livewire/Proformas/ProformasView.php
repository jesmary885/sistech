<?php

namespace App\Http\Livewire\Proformas;

use App\Models\Proforma;
use Livewire\Component;
use Livewire\WithPagination;

class ProformasView extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";


    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $proformas = Proforma::where('fecha', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(5);


        return view('livewire.proformas.proformas-view',compact('proformas'));
    }
}
