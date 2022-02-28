<div>
    <button type="submit" class="btn btn-primary btn-sm" wire:click="open">
        <i class="fas fa-check"></i>
   </button> 

   @if($isopen)
        <div x-data>
            <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar productos a la venta</h5>
                        </div>
                        <div class="modal-body">
             
                                {{-- <div class="mr-4">
                                    <x-secondary-button 
                                        disabled
                                        x-bind:disabled="$wire.qty <= 1"
                                        wire:loading.attr="disabled"
                                        wire:target="decrement"
                                        wire:click="decrement">
                                        -
                                    </x-secondary-button>
                        
                                    <span class="mx-2 text-gray-700">{{$qty}}</span>
                        
                                    <x-secondary-button 
                                        x-bind:disabled="$wire.qty >= $wire.cantidad"
                                        wire:loading.attr="disabled"
                                        wire:target="increment"
                                        wire:click="increment">
                                        +
                                    </x-secondary-button>
                                </div> --}}

                                <div class="w-1/2">
                                    <select id="precios" wire:model="precios" class="block bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                                        <option value="" selected>Precio de venta</option>
                                        <option value="1">Precio letal</option>
                                        <option value="2">Precio al mayor</option>
                                    </select>
                                    <x-input-error for="precios" />

                                </div>

           
                        </div>


                        <div class="modal-footer flex">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" wire:click="close" >Cerrar</button>
                            <x-button
                                x-bind:disabled="$wire.qty > $wire.cantidad"
                                wire:click="addItem"
                                wire:loading.attr="disabled"
                                wire:target="addItem">
                                Agregar a la venta
                            </x-button>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
   @endif
</div>


