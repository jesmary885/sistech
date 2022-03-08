<div>
    <button type="submit" class="btn btn-primary btn-sm"
        @if ($accion == 'create')
            title = "Registro de cliente"
        @else
            title="Editar cliente"
        @endif wire:click="open">
        
        @if ($accion == 'create')
            <i class="fas fa-user-plus"></i>
                @if ($vista=='clientes')
                    Nuevo cliente
                @endif
            @else
            <i class="fas fa-user-edit"></i>
        @endif
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;"
            wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
           
                        <h5 class="modal-title py-0 text-lg text-gray-800"> <i class="fas fa-user-tie"></i>  Registro de clientes</h5>
                    </div>
                    <div class="modal-body">

                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-500 font-semibold"><i class="fas fa-info-circle"></i> Complete todos los campos y presiona Guardar</h2> 
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-500 font-semibold"><i class="fas fa-info-circle"></i> El campo Email debe registrarlo completo, ejemplo: maria@gmail.com </h2> 
                        <hr>
                        <div class="flex mt-2 justify-between w-full">
                            <div class="w-3/4 mr-2">
                                <select wire:model="tipo_documento" id="tipo_documento"
                                    class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="tipo_documento" title="Tipo de documento">
                                    <option value="" selected>*Doc.</option>
                                    <option value="1">DUI</option>
                                    <option value="2">DNI</option>
                                    <option value="3">Cedula</option>
                                    <option value="4">Licencia</option>
                                    <option value="5">Pasaporte</option>
                                    <option value="6">Otro</option>
                                </select>
                                <x-input-error for="tipo_documento" />
                            </div>
                            <div class="w-full mr-2">
                                <input wire:model.defer="nro_documento" name="documento" type="text"
                                    class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="*Nro de documento" title="Nro de documento">
                                <x-input-error for="nro_documento" />
                            </div>
                            <div class="w-full mr-2">
                                <input wire:model="telefono" type="number"
                                    class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="*Teléfono" title="Teléfono">
                                <x-input-error for="telefono" />
                            </div>
                        </div>

                        <div class="flex justify-between w-full mt-2 mr-2">
                            <div class="w-full mr-2">
                                <input wire:model="nombre" type="text"
                                    class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="*Nombres" title="Nombre">
                                <x-input-error for="nombre" />
                            </div>
                            <div class="w-full mr-2">
                                <input wire:model="apellido" type="text"
                                    class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="*Apellidos" title="Apellido">
                                <x-input-error for="apellido" />
                            </div>
                        </div>

                        <div class="flex justify-between w-full mt-2 mr-2">

                            <div class="w-full mr-2">
                                <input wire:model="email" type="email"
                                    class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="*E-mail" title="E-mail">
                                <x-input-error for="email" />
                            </div>

                            <div class="w-full mr-2">
                                <input wire:model="direccion" type="text"
                                    class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="*Dirección" title="Dirección">
                                <x-input-error for="direccion" />
                            </div>

                        </div>

                        <div class="flex justify-between w-full mt-2">
                            <div class="w-full mr-2">
                                        <select title="Estado/provincia/region" wire:model="estado_id"
                                class="w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" selected>*Estado/provincia/region</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="estado_id" />
                            </div>
                            <div class="w-full mr-2">
                            <select title="Ciudad" wire:model="ciudad_id"
                                    class="w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="" selected>*Seleccione la ciudad</option>
                                    @foreach ($ciudades as $ciudad)
                                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="ciudad_id" />
                            </div>

                          
                        </div>
                       
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button  wire:loading.attr="disabled" type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
