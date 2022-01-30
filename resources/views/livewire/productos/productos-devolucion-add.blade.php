<div x-data="{ factura: @entangle('factura')}">
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
                        <div :class="{'hidden': factura != 1}">
                            <input wire:model="nro_factura" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nro. de factura">
                        </div>
                        <div :class="{'hidden': factura != 0}">
                            <div class="flex justify-between w-full mt-2">
                                <select wire:model="producto_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="" selected>Seleccione el producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{$producto->producto->id}}">{{$producto->producto->nombre}}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="producto_id" />

                                <select id="accion" wire:model="accion" class="ml-2 block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="accion">
                                    <option value="" selected>Acción</option>
                                    <option value="1">Reintegro del dinero</option>
                                    <option value="2">Entrega de otro producto igual</option>
                                    <option value="3">Entrega de otro producto distinto</option>
                                </select>
                                <x-input-error for="accion" />
                            </div>
                            <div>
                                <textarea wire:model="observaciones" class="mt-2 resize-none rounded-md outline-none w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="observaciones" cols="80" rows="2" required placeholder="Observaciones"></textarea>  
                            </div>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close" >Cerrar</button>
                        <div :class="{'hidden': factura != 1}">
                            <button type="button" class="btn btn-primary disabled:opacity-25" wire:loading.attr="disabled" wire:click="buscar('{{$nro_factura}}}')">Buscar</button>
                        </div>
                        <div :class="{'hidden': factura != 0}">
                            <button type="button" class="btn btn-primary disabled:opacity-25" wire:loading.attr="disabled" wire:click="save">Guardar</button>
                        </div>
                    </div>
                </div>
              
            </div>
            
        </div>
   @endif
</div>

