<div>
    <button type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="fas fa-plus-square"></i>
   </button> 

   @if($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pago de venta a crédito</h5>   
                    </div>
                    <div class="modal-body">
                        <div class="w-1/3 mt-2">
                         
                                <input wire:model="total_pagado_cliente" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Total pagado">
                                <x-input-error for="total_pagado_cliente" />
                         
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close" >Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="update">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
   @endif
</div>