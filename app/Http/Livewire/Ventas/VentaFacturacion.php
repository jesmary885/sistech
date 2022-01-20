<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Cliente;
use App\Models\Movimiento;
use App\Models\Venta;
use Facade\FlareClient\Http\Client;
use Gloudemans\Shoppingcart\Facades\Cart;
Use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade;
use Barryvdh\DomPDF\ServiceProvider;
use PDF;

use Illuminate\Http\Request;


use Livewire\Component;

class VentaFacturacion extends Component
{

    public $tipo_pago = 1;
    public $metodo_pago, $total, $client;
    public $sucursal,$cliente_select, $pago_cliente, $deuda_cliente, $descuento, $estado_entrega;
    public $siguiente_venta = 0;

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search;

    public $rules = [
        'tipo_pago' => 'required',
        'metodo_pago' => 'required',
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatedTipoPago($value){
        if ($value == 1) {
            $this->resetValidation([
                'deuda_cliente', 'pago_cliente'
            ]);
        }
    } 

    public function render()
    {

        $clientes = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->orwhere('nro_documento', 'LIKE', '%' . $this->search . '%')
        ->paginate(2);

        return view('livewire.ventas.venta-facturacion',compact('clientes'));
    }

    public function mount()
    {
        $this->cliente_select = "";
    }

    public function select_u($cliente_id){
        $this->client = Cliente::where('id',$cliente_id)->first();
        $this->cliente_select = $this->client->nombre." ".$this->client->apellido;
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);
        $user_auth =  auth()->user()->id;
        $descuento_total = (Cart::subtotal() * $this->descuento) / 100;
        $total_venta = ((Cart::subtotal() * 0.15) + Cart::subtotal()) - $descuento_total;
        $fecha_actual = date('Y-m-d');

        $venta = new Venta();
        $venta->user_id = $user_auth;
        $venta->cliente_id = $this->client->id;
        $venta->fecha = $fecha_actual;
        $venta->tipo_pago = $this->tipo_pago;
        $venta->metodo_pago = $this->metodo_pago;
        if ($this->tipo_pago == "2"){
            $venta->total_pagado_cliente = $this->pago_cliente;
            $venta->deuda_cliente = $total_venta - $this->pago_cliente;
        }
        else{
            $venta->total_pagado_cliente = $total_venta;
            $venta->deuda_cliente = "0";
        }
        $venta->subtotal = Cart::subtotal();
        $venta->total = $total_venta;
        $venta->sucursal_id = $this->sucursal;
        $venta->estado_entrega = $this->estado_entrega;
        $venta->descuento = $this->descuento;
        $venta->save();

        foreach (Cart::content() as $item) {
            $venta->producto_ventas()->create([
                'venta_id' => $venta->id,
                'producto_id'=> $item->id,
                'cantidad' => $item->qty
            ]);
            $movimiento = new Movimiento();
            $movimiento->fecha = $fecha_actual;
            $movimiento->tipo_movimiento = 'venta de producto';
            $movimiento->cantidad = $item->qty;
            $movimiento->precio = $item->price;
            $movimiento->observacion = 'sin observacion';
            $movimiento->producto_id = $item->id;
            $movimiento->user_id = $user_auth;
            $movimiento->save();
            discount($item,$this->sucursal);
        }
      
        $data = [
              'cliente_nombre' => $this->client->nombre." ".$this->client->apellido,
              'cliente_documento' =>$this->client->nro_documento,
              'cliente_telefono' =>$this->client->telefono,
              'usuario' => auth()->user()->name." ".auth()->user()->apellido,
              'fecha_actual' => $fecha_actual,
              'venta_nro' => $venta->id,
              'collection' => Cart::content(),
              'estado_entrega' => $this->estado_entrega,
              'descuento' => $this->descuento,
              'subtotal' => Cart::subtotal()
          ];
    
         $pdf = PDF::loadView('ventas.FacturaContado',$data)->output();
          
         cart::destroy();
       
        return response()->streamDownload(
         fn () => print($pdf),
        "filename.pdf"
         );

         $this->siguiente_venta = '1';
    }

    public function nueva_venta(){
        return redirect()->route('ventas.ventas.index');
    }

    public function inicio(){
        
    }
}
