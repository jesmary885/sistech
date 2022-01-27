<div>
    <button type="submit" class="btn btn-primary btn-sm" wire:click="open">
        <i class="fas fa-exchange-alt"></i> Registrar devolución
   </button> 

   @if($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registro de la devolucion</h5>
                    </div>
                    <div class="modal-body">
                        
                          
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close" >Cerrar</button>
                        <button type="button" class="btn btn-primary disabled:opacity-25" wire:loading.attr="disabled" wire:click="save">Guardar</button>
                    </div>
                </div>
              
            </div>
            
        </div>
   @endif
</div>

