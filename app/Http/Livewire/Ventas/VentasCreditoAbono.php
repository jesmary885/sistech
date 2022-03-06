<?php

namespace App\Http\Livewire\Ventas;

use Livewire\Component;

class VentasCreditoAbono extends Component
{
    
    public $venta,$total_pagado_cliente;
    public $isopen = false;
    public $vista;

      
    protected $rules = [
        'total_pagado_cliente' => 'required',
    ];


    public function render()
    {
        return view('livewire.ventas.ventas-credito-abono');
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function update(){
        $rules = $this->rules;
        $this->validate($rules);

        if ($this->total_pagado_cliente < 0){
            $this->emit('errorSize','Ha ingresado un valor negativo, intentelo de nuevo');
            $this->reset(['total_pagado_cliente']);
        }

        elseif($this->total_pagado_cliente > $this->venta->deuda_cliente){
            $this->emit('errorSize','El valor ingresado es mayor que la deuda del cliente, intentelo de nuevo');
            $this->reset(['total_pagado_cliente']);
        }

        else{

            $total_pagado = $this->venta->total_pagado_cliente + $this->total_pagado_cliente;
            $deuda_total = $this->venta->total - $total_pagado;
    
                $this->venta->update([
                    'total_pagado_cliente' => $total_pagado,
                    'deuda_cliente' => $deuda_total
                ]);

                $this->reset(['isopen']);
                if($this->vista==1){
                    $this->emitTo('ventas.ventas-por-cliente','render');

                }else{
                    $this->emitTo('ventas.ventas-credito','render');
                }
                
                $this->emit('alert','Pago registrado correctamente');
                $this->reset(['total_pagado_cliente']);
        }
    }

}
