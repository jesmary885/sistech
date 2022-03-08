<div>
    <div class="card">
        <h1 class="py-0 text-lg text-gray-500 ml-4 mt-1"> <i class="fas fa-building"></i> Información sobre la empresa</h1>
    </div>

    <div class="card w-full pt-0 m-0">
        <div class="card-body w-full pt-0 mt-0">
            <div class="flex">
                  <i class="far fa-address-card mt-3 mr-1"></i>
                <h2 class="text-lg inline mt-2"> Datos de la empresa</h2>
            </div>

            <div class="flex mt-2 justify-between w-full">
                <div class="w-full mr-2">
                  <select wire:model="tipo_documento" title="Tipo de documento" id="tipo_documento" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_documento">
                         <option value="" selected>Tipo de documento</option>
                         <option value="1">DUI</option>
                         <option value="2">RUC</option>
                         <option value="3">DNI</option>
                         <option value="4">Cedula</option>
                         <option value="5">Licencia</option>
                         <option value="6">Pasaporte</option>
                         <option value="7">Otro</option>
                     </select>
                     <x-input-error for="tipo_documento" />
                </div>
                <div class="w-full mr-2">
                    <input wire:model="documento" title="Nro de documento" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nro de documento">
                    <x-input-error for="documento" />
                </div>
                 <div class="w-full">
                        <input wire:model="nombre" title="Nombre de la empresa" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombre">
                        <x-input-error for="nombre" />
                 </div>      
              
            </div>

            <div class="w-full mr-2 mt-2">
                <input wire:model="direccion" title="Dirección de la empresa" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Dirección">
                <x-input-error for="direccion" />
            </div>

            <hr>


            <div class="flex">
                <i class="fas fa-phone-volume mt-2 mr-1"></i>
              <h2 class="text-lg inline mt-1"> Información de contacto</h2>
          </div>

            <div class="flex justify-between w-full mt-3 mr-2">
                <div class="w-full mr-2">
                    <input wire:model="telefono" title="Teléfono de contacto" type="number" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Telefono">
                    <x-input-error for="telefono" />
                </div>
                <div class="w-full m">
                    <input wire:model="email" type="email" title="Email de la empresa" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="E-mail">
                    <x-input-error for="email" />
                </div>
    
            </div>
            <hr>

            <div class="flex">
                <i class="fas fa-file-invoice-dollar mt-2 mr-1"></i>
              <h2 class="text-lg inline mt-1"> Información de impuesto y descuentos por canjes de puntos</h2>
          </div>

            <div class="flex justify-between w-full mt-3 mr-2">
                <div class="w-full mr-2">
                    <input wire:model="nombre_impuesto" title="Nombre del impuesto" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombre del impuesto">
                    <x-input-error for="nombre_impuesto" />
               </div>  
                <div class="w-full mr-2">
                    <input wire:model="impuesto" type="number" min="0" title="valor del mpuesto" class="px-2 appearance-none block w-full bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="valor del impuesto">
                    <x-input-error for="impuesto" />
                </div>

                <div class="w-full">
                    <input wire:model="porcentaje_puntos" type="number" min="0" title="Porcentaje de decuento en venta" class="px-2 appearance-none block w-full bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Porcentaje">
                    <x-input-error for="porcentaje_puntos" />
                </div>

               
            </div>
       

            <div class="mt-4">
                <button type="submit" class="btn btn-primary" wire:click="update">
                    <i class="fas fa-file-download"></i> Actualizar
                </button>
            </div>
        </div>
    </div>
</div>