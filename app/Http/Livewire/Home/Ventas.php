<?php

namespace App\Http\Livewire\Home;

use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class Ventas extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $usuario_auth = auth()->user();
        $fecha_actual = date('Y-m-d');

        $usuario_ac = $usuario_auth->sucursal->nombre;
        $sucursal_act = $usuario_auth->sucursal->id;

        $ventas = Venta::where('fecha', $fecha_actual)
        ->where('sucursal_id',$sucursal_act)
        ->where('estado', 'activa')
        ->paginate(5);

        return view('livewire.home.ventas',compact('ventas','usuario_ac'));
    }

    public function export_pdf(){

        $usuario_auth = auth()->user();
        $fecha_actual = date('Y-m-d');
        $fecha = date('d-m-Y');

        $usuario_ac = $usuario_auth->sucursal->nombre;
        $sucursal_act = $usuario_auth->sucursal->id;

        $ventas = Venta::where('fecha', $fecha_actual)
        ->where('sucursal_id',$sucursal_act)
        ->where('estado', 'activa')
        ->paginate(5);

        $data = [
            'ventas' => $ventas,
            'sucursal' =>$usuario_ac,
            'fecha' =>$fecha,
        ];

        $pdf = PDF::loadView('ventas.home',$data)->output();

        return response()->streamDownload(
            fn () => print($pdf),
           "Ventas_del_dia.pdf"
            );

    }
}
