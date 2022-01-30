<div>
    <button type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="fas fa-edit"></i>
   </button> 

   @if($isopen)
    <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Producto</h5>
            </div>
            <div class="modal-body mt-0">
                <div class="flex justify-between w-full mt-0">
                    <div class="w-full">
                        <label class="text-sm text-gray-600 w-full">Nombre</label>
                        <input wire:model="nombre" type="text" class="mt-0 px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombre">
                        <x-input-error for="nombre" />
                    </div>
                    <div class="w-full">
                        <label class="text-sm text-gray-600 w-full">Código de barra</label>
                        <input wire:model="cod_barra" type="text" class="mt-0 px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cód de barra">
                        <x-input-error for="cod_barra" />
                    </div>
                </div>
                <div class="flex mt-2 justify-between w-full">
                    <div class="mr-2">
                        <label class="text-sm text-gray-600">Precio de entrada</label>
                    <input wire:model.defer="precio_entrada" name="precio_entrada" type="text" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio de compra">
                    <x-input-error for="precio_entrada" />
                    </div>
                    
                    <div class="mr-2">
                    <label class="text-sm text-gray-600">Precio al letal</label>
                    <input wire:model.defer="precio_letal" name="precio_letal" type="text" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio al detal">
                    <x-input-error for="precio_letal" />
                </div>
                <div>
                    <label class="text-sm text-gray-600">Precio al mayor</label>
                    <input wire:model="precio_mayor" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio al mayor">
                    <x-input-error for="precio_mayor" />
                </div>
                </div>
                <div class="flex mt-2 justify-between w-full">
                    <input wire:model.defer="cantidad" name="cantidad" type="text" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cantidad">
                    <x-input-error for="cantidad" />
                    <input wire:model.defer="inventario_min" name="inventario_min" type="text" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Stock minimo">
                    <x-input-error for="inventario_min" />
                    <select wire:model="presentacion" id="presentacion" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="presentacion">
                        <option value="" selected>Presentación</option>
                        <option value="1">Unidades</option>
                        <option value="2">Juegos</option>
                        <option value="3">Kilogramos</option>
                        <option value="4">Gramos</option>
                        <option value="5">Litros</option>
                        <option value="6">Metros</option>
                        <option value="7">Atados</option>
                    </select>
                    <x-input-error for="presentacion" />
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