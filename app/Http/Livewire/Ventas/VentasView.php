<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto_venta;
use Livewire\Component;

class VentasView extends Component
{

    public $venta, $fecha_creacion, $factura_nro, $nombre_cliente, $apellido_cliente, $tipo_doc_cliente, $doc_cliente, $nombre_usuario, $apellido_usuario, $sucursal, $subtotal, $descuento, $impuesto, $total;


    public $isopen = false;

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }
    public function mount(){
        $this->fecha_creacion = $this->venta->fecha;
        $this->factura_nro = $this->venta->id;
        $this->nombre_cliente = $this->venta->cliente->nombre;
        $this->apellido_cliente = $this->venta->cliente->apellido;
        $this->tipo_doc_cliente = $this->venta->cliente->tipo_documento;
        $this->doc_cliente = $this->venta->cliente->nro_documento;
        $this->nombre_usuario = $this->venta->user->name;
        $this->apellido_usuario = $this->venta->user->apellido;
        $this->sucursal = $this->venta->sucursal->nombre;
        $this->subtotal = $this->venta->subtotal;
        $this->descuento = $this->venta->descuento;
        $this->impuesto = '0';
        $this->total = $this->venta->total;
    }
    public function render()
    {
        $productos = Producto_venta::where('venta_id',$this->venta->id)->get();
        return view('livewire.ventas.ventas-view',compact('productos'));
    }
}
