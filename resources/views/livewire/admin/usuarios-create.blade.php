<div>
       <div class="card">
           <h1 class="py-0 text-lg text-gray-500 ml-4 mt-1"> <i class="fas fa-user-tie"></i> Nuevo usuario</h1>
       </div>
   
       <div class="card w-full pt-0 m-0">
           <div class="card-body w-full pt-0 mt-0">
               <div class="flex">
                     <i class="far fa-address-card mt-3 mr-1"></i>
                   <h2 class="text-lg inline mt-2 underline decoration-gray-400"> Información personal</h2>
               </div>
               <div class="flex mt-2 justify-between w-full">
                   <div class="w-full mr-2">
                     <select wire:model="tipo_documento" id="tipo_documento" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_documento">
                            <option value="" selected>Tipo de documento</option>
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
                       <input wire:model="documento" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nro de documento">
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
                       <input wire:model="apellido" type="apellido" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Apellidos">
                       <x-input-error for="apellido" />
                   </div>
                   <div class="w-full mr-2">
                       <input wire:model="email" type="email" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="E-mail">
                       <x-input-error for="email" />
                   </div>
       
               </div>
   
               <div class="flex justify-between w-full mt-3 mr-2">
                   <div class="w-full mr-2">
                       <input wire:model="direccion" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Dirección">
                       <x-input-error for="direccion" />
                   </div>
                   <div class="w-full mr-2">
                    <select wire:model="estado_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Estado/provincia/region</option>
                        @foreach ($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="estado_id" />
                </div>

                   <div class="w-full">
                    <select wire:model="ciudad_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Seleccione la ciudad</option>
                        @foreach ($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="ciudad_id" />
                   </div>
                    
                   
               </div>
   
            
               <div class="flex mt-4">
                    <i class="fas fa-user-lock mt-3 mr-1"></i>
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
                    <i class="fas fa-location-arrow mt-3 mr-1"></i>
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

   
               <div class="py-12">
                   <button type="submit" class="btn btn-primary" wire:click="save">
                       <i class="fas fa-file-download"></i> Guardar
                   </button>
                <a href="{{route('admin.usuarios.index')}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a>
               </div>
           </div>
       </div>
   </div>