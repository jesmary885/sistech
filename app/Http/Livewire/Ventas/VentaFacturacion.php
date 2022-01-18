<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Cliente;
use App\Models\Movimiento;
use App\Models\Venta;
use Facade\FlareClient\Http\Client;
use Gloudemans\Shoppingcart\Facades\Cart;
Use Livewire\WithPagination;

use Livewire\Component;

class VentaFacturacion extends Component
{

    public $tipo_pago, $metodo_pago, $total, $decuda_cliente, $client;
    public $sucursal,$cliente_select;

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
        $total_venta = (Cart::subtotal() * 0.15) + Cart::subtotal();
        $fecha_actual = date('Y-m-d');

        $venta = new Venta();
        $venta->user_id = $user_auth;
        $venta->cliente_id = $this->client->id;
        $venta->fecha = $fecha_actual;
        $venta->tipo_pago = $this->tipo_pago;
        $venta->metodo_pago = $this->metodo_pago;
        $venta->subtotal = Cart::subtotal();
        $venta->total = $total_venta;
        $venta->sucursal_id = $this->sucursal;
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
        cart::destroy();
    }
}
