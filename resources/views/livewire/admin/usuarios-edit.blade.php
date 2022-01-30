<div>
     <button type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="fas fa-user-edit"></i>
    </button> 

    @if($isopen)
    
    <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar usuario</h5>
             
            </div>
            <div class="modal-body">

                <div class="flex mt-2 justify-between w-full">
                    <div class="w-full mr-2">
                      <select wire:model="tipo_documento" id="tipo_documento" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_documento">
                             <option value="" selected>Tipo de doc.</option>
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
                        <input wire:model.defer="documento" name="documento" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nro de documento">
                        <x-input-error for="documento" />
                    </div>
                     <div class="w-full">
                      <input wire:model="telefono" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Telefono">
                      <x-input-error for="telefono" />
                  </div>
                </div>

                <div class="flex justify-between w-full mt-3 mr-2">
                    <div class="w-full mr-2">
                        <input wire:model="name" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombres">
                        <x-input-error for="name" />
                    </div>
                    <div class="w-full mr-2">
                        <input wire:model="apellido" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Apellidos">
                        <x-input-error for="apellido" />
                    </div>
                </div>

                <div class="flex justify-between w-full mt-3 mr-2">
                 
                    <div class="w-full mr-2">
                        <input wire:model="email" type="email" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="E-mail">
                        <x-input-error for="email" />
                    </div>

                    <div class="w-full mr-2">
                        <input wire:model="direccion" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Dirección">
                        <x-input-error for="direccion" />
                    </div>
        
                </div>

                <div class="flex justify-between w-full mt-3 mr-2">
                 
                    <div class="w-full mr-2">
                        <select wire:model="ciudad_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Seleccione la ciudad</option>
                             @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="ciudad_id" />
                    </div>

                    <div class="w-full">
                        <select wire:model="estado_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Estado/provincia/region</option>
                             @foreach ($estados as $estado)
                                <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                            @endforeach 
                        </select>
                        <x-input-error for="estado_id" />
                    </div>

               
        
                </div>




                <div class="flex mt-4">
            
                   <h2 class="text-lg inline underline decoration-gray-400 mt-2">Información de la cuenta</h2>
               </div>
   
               <div class="flex justify-between w-full mt-3 mr-2">
                    <div class="w-full mr-2">
                        <input wire:model="password" type="text" id="password" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Contraseña">
                        <x-input-error for="password" />
                    </div>
                    <div class="w-full mr-2">
                        <input wire:model="password_confirm" id="password_confirm" name="password_confirmation" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Repetir contraseña">
                        <x-input-error for="password_confirm" />
                    </div>
                </div>
                <div class="flex justify-between w-full mt-3 mr-2">
                    <div class="w-full mr-2">
                        <select wire:model="estado" id="estado" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="estado">
                            <option value="" selected>Estado de la cuenta</option>
                            <option value="1">Activa</option>
                            <option value="2">Inactiva</option>
                        </select>
                        <x-input-error for="estado" />
                    </div>
                    <div class="w-full">
                        <select wire:model="roles_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Rol del usuario</option>
                                @foreach ($roles as $rol)
                            <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="roles_id" />
                    </div>
                </div>

                <div class="flex mt-4">
             
                   <h2 class="text-lg inline underline decoration-gray-400 mt-2">Zona de atención</h2>
               </div>

               <div class="flex justify-between w-full mt-3 mr-2">
                
                
                <div class="w-full mr-2">
                    <select wire:model="limitacion" id="limitacion" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="estado">
                        <option value="" selected>Limitación de acceso</option>
                        <option value="1">Selección Libre</option>
                        <option value="2">Una sucursal</option>
                    </select>
                    <x-input-error for="limitacion" />
                </div>
                <div class="w-full">
                    <select wire:model="sucursales_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Sucursal de atención</option>
                            @foreach ($sucursales as $sucursal)
                        <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="sucursales_id" />
                </div>
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

