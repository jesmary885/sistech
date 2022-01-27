<?php

namespace App\Http\Livewire\Ventas;

use Livewire\Component;

class VentasCreditoAbono extends Component
{
    
    public $venta,$total_pagado_cliente;
    public $isopen = false;

      
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

        $total_pagado = $this->venta->total_pagado_cliente + $this->total_pagado_cliente;
        $deuda_total = $this->venta->total - $total_pagado;
 
            $this->venta->update([
                'total_pagado_cliente' => $total_pagado,
                'deuda_cliente' => $deuda_total
            ]);

            $this->reset(['isopen']);
            $this->emitTo('ventas.ventas-credito','render');
            $this->emit('alert','Pago registrado correctamente');
    }

   


}
