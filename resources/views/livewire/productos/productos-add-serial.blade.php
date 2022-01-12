<div>
    <button type="submit" class="btn btn-primary btn-sm" wire:click="open">
        <i class="fas fa-edit"></i>
   </button> 

   @if($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregue el serial del producto</h5>
                    </div>
                    <div class="modal-body">
                        <div class="w-full mr-2">
                            <input wire:model="serial" name="serial" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="serial">
                            <x-input-error for="serial" />
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close" >Cerrar</button>
                    <button type="button" class="btn btn-primary disabled:opacity-25" wire:loading.attr="disabled" wire:click="save">Guardar</button>
                </div>
            </div>
        </div>
   @endif
</div>
