<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Movimiento;
use App\Models\Movimiento_product_serial;
use App\Models\Producto;
use App\Models\ProductoSerialSucursal;
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
    public $sucursal,$cliente_select, $pago_cliente, $deuda_cliente, $descuento, $estado_entrega,$subtotal;
    public $siguiente_venta = 0;
    public $iva;
    public $puntos_canjeo, $canjeo, $puntos_canjeados, $descuento_total,$porcentaje_descuento_puntos = 0,$empresa;
 
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];
    
    public $rules = [
        'tipo_pago' => 'required',
        'metodo_pago' => 'required',
        'estado_entrega' => 'required',
        'descuento' => 'required',
        'cliente_select' => 'required',
    ];
    public $rule_credito = [
        'tipo_pago' => 'required',
        'metodo_pago' => 'required',
        'estado_entrega' => 'required',
        'descuento' => 'required',
        'pago_cliente' => 'required',
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

        $this->empresa = Empresa::first();
        $this->iva = ($this->empresa->impuesto)/100;

        if($this->descuento != null)  $this->descuento = $this->descuento;
        else $this->decuento = (int) $this->descuento;       
        

        $clientes = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->orwhere('apellido', 'LIKE', '%' . $this->search . '%')
        ->orwhere('nro_documento', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(2);

        return view('livewire.ventas.venta-facturacion',compact('clientes'));
    }

    public function mount()
    {
        $this->cliente_select = "";
        $this->puntos_canjeo = "0";
        $this->canjeo = false;
        $this->puntos_canjeados = 0;
        //$this->descuento_total = 0;
    }

    public function select_u($cliente_id){
        $this->client = Cliente::where('id',$cliente_id)->first();
        $this->cliente_select = $this->client->nombre." ".$this->client->apellido;
        $this->puntos_canjeo = $this->client->puntos;
      
       // $this->puntos_canjeo = "0";
    }

    public function save(){
        if ($this->tipo_pago == "1"){
        $rules = $this->rules;
        $this->validate($rules);
        }
        else{
        $rule_credito = $this->rule_credito;
        $this->validate($rule_credito);   
        }

        $user_auth =  auth()->user()->id;
        $impuesto= Cart::subtotal() * $this->iva;
          //PROCESO DE SUMAR O RESTAR PUNTOS EN TABLA DE CLIENTES

          if($this->canjeo==false){
            $descuento_total = Cart::subtotal() * ($this->descuento / 100);
            $total_venta = ($impuesto + Cart::subtotal()) - $descuento_total;
           // dd(round($total_venta,0));
            $nuevos_puntos = $this->client->puntos + round($total_venta,0);

            $this->client->update([
                'puntos' => round($nuevos_puntos),
            ]);
        }else{
            $descuento_total = Cart::subtotal() * (($this->descuento / 100) + ($this->porcentaje_descuento_puntos / 100));
            $total_venta = ($impuesto + Cart::subtotal()) - $descuento_total;
            //verifica si es porque debes colocar entero el total velo con dd a ver que te trae
            
            $nuevos_puntos = ($this->client->puntos - $this->puntos_canjeados) + round($total_venta,0);

            $this->client->update([
                'puntos' => round($nuevos_puntos),
            ]);
        }

        //FIN DE PROCESO

        //$descuento_total = (Cart::subtotal() * $this->descuento) / 100;
        
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
        $venta->estado='activa';
        $venta->save();

      

        foreach (Cart::content() as $item) {
            //generando producto_por_serial_venta
            $venta->producto_ventas()->create([
                'venta_id' => $venta->id,
                'producto_serial_sucursal_id'=> $item->id,
                'precio' => $item->price,
                'cantidad' => 1,
            ]);
            
            $producto_item = ProductoSerialSucursal::where('id',$item->id)->first();
            $producto_item->update([
                'estado' => 'inactivo',
            ]);

            $movimiento = new Movimiento_product_serial();
            $movimiento->fecha = $fecha_actual;
            $movimiento->tipo_movimiento = 'venta de producto';
            $movimiento->precio = $item->price;
            $movimiento->observacion = 'sin observacion';
            $movimiento->producto_serial_sucursal_id = $item->id;
            $movimiento->user_id = $user_auth;
            $movimiento->save();
            //descuento la cantidad
            discount($producto_item->producto->id,$this->sucursal);
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
         $this->reset(['cliente_select','pago_cliente','descuento','descuento_total']);
       
        return response()->streamDownload(
         fn () => print($pdf),
        "Factura.pdf"
         );
         
    }

    public function canjear($producto_id){
        $this->puntos_canjeo = "1";
        $this->canjeo = true;
    
        $this->porcentaje_descuento_puntos = $this->empresa->porcentaje_puntos;
        $product_canje = ProductoSerialSucursal::where('id',$producto_id)->first();
        

        $this->puntos_canjeados = $product_canje->producto->puntos;
        $this->descuento_total = Cart::subtotal() * (($this->descuento / 100) + ($this->porcentaje_descuento_puntos / 100));

       
       
    }

    public function nueva_venta(){
        return redirect()->route('ventas.ventas.index');
    }

    public function inicio(){
        return redirect()->route('home');
    }
}
