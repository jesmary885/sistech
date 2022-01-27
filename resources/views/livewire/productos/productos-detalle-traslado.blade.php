<div>
    <button type="submit" class="btn btn-primary btn-sm" wire:click="open">
        <i class="fas fa-check"></i>
   </button> 

   @if($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalles del traslado</h5>
                    </div>
                    <div class="modal-body">
                        <div class="flex mt-2 ustify-between w-full">
                            <div class="w-full mr-2">
                                <input wire:model.defer="cantidad" name="documento" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cantidad a trasladar">
                                <x-input-error for="cantidad" />
                            </div>
                            <div class="w-full">
                              
                                    <select wire:model="sucursal_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="" selected>Sucursal destino
                                        </option>
                                        @foreach ($sucursales as $sucursal)
                                            <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                        @endforeach
                                    </select>
                                 
                                <x-input-error for="sucursal_id" />
                            </div>
                          
                        </div>
                       
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

