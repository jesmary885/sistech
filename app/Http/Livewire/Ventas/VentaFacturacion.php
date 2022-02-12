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

    use WithPagination;
    public $tipo_pago = 1;
    public $metodo_pago, $total, $client, $search;
    public $sucursal,$cliente_select, $pago_cliente, $deuda_cliente, $descuento, $estado_entrega;
    public $siguiente_venta = 0;
    public $iva = 0.15;
 
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];
    
    public $rules = [
        'tipo_pago' => 'required',
        'metodo_pago' => 'required',
        'cliente_select' => 'required',
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
        ->latest('id')
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

        //$descuento_total = (Cart::subtotal() * $this->descuento) / 100;

        $descuento_total = Cart::subtotal() * ($this->descuento / 100);
        $impuesto= Cart::subtotal() * $this->iva;

        $total_venta = ($impuesto + Cart::subtotal()) - $descuento_total;

        
        $fecha_actual = date('Y-m-d');

        if($this->estado_entrega == "1") $entrega = 'Entregado'; else
        $entrega = 'Por entregar';

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
        $venta->estado_entrega = $entrega;
        $venta->descuento = $descuento_total;
        $venta->impuesto=$impuesto;
        $venta->save();

        foreach (Cart::content() as $item) {
            $venta->producto_ventas()->create([
                'venta_id' => $venta->id,
                'producto_id'=> $item->id,
                'cantidad' => $item->qty,
                'precio' => $item->price
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

      

        if ($this->tipo_pago == "1"){
            $data = [
                'cliente_nombre' => $this->client->nombre." ".$this->client->apellido,
                'cliente_documento' =>$this->client->nro_documento,
                'cliente_telefono' =>$this->client->telefono,
                'usuario' => auth()->user()->name." ".auth()->user()->apellido,
                'fecha_actual' => $fecha_actual,
                'venta_nro' => $venta->id,
                'collection' => Cart::content(),
                'estado_entrega' => $entrega,
                'descuento' => $descuento_total,
                'subtotal' => Cart::subtotal(),
                'subtotal_menos_descuento' => Cart::subtotal() - ($descuento_total),
                'impuesto' => $impuesto,
                'total' => $total_venta,
                'iva' => $this->iva,

                
            ];
           $pdf = PDF::loadView('ventas.FacturaContado',$data)->output();
        }
        else{
            $data = [
                'cliente_nombre' => $this->client->nombre." ".$this->client->apellido,
                'cliente_documento' =>$this->client->nro_documento,
                'cliente_telefono' =>$this->client->telefono,
                'usuario' => auth()->user()->name." ".auth()->user()->apellido,
                'fecha_actual' => $fecha_actual,
                'venta_nro' => $venta->id,
                'collection' => Cart::content(),
                'estado_entrega' => $entrega,
                'descuento' => $descuento_total,
                'pagado' => $this->pago_cliente,
                'deuda' => $total_venta - $this->pago_cliente,
                'impuesto' => $impuesto,
                'subtotal' => Cart::subtotal(),
                'total' => $total_venta,
                'iva' => $this->iva,

            ];
           $pdf = PDF::loadView('ventas.FacturaCredito',$data)->output();
        }
         cart::destroy();
         $this->siguiente_venta = '1';
         $this->reset(['cliente_select','pago_cliente','descuento']);
       
        return response()->streamDownload(
         fn () => print($pdf),
        "Factura.pdf"
         );
         
    }

    public function nueva_venta(){
        return redirect()->route('ventas.ventas.index');
    }

    public function inicio(){
        return redirect()->route('home');
    }
}
