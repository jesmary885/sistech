<div>
    <div class="card">
        <h5 class="modal-title py-0 text-lg text-gray-800 ml-4"> <i class="fas fa-database"></i>  Registro de equipo</h5>
    </div>

    <div class="card w-full pt-0 m-0">
        <div class="card-body w-full pt-0 mt-0">
            <div class="mt-2">
                <h2 class="text-sm ml-2 m-0 p-0 text-gray-500 font-semibold"><i class="fas fa-info-circle"></i> Complete todos los campos y presiona Guardar</h2>
                <h2 class="text-sm ml-2 m-0 p-0 text-gray-500 font-semibold"><i class="fas fa-info-circle"></i> El código de barra debe tener mínimo 8 y máximo 12 caracteres</h2> 
                <h2 class="text-sm ml-2 m-0 p-0 text-gray-500 font-semibold"><i class="fas fa-info-circle"></i> Campos opcionales: Observaciones e imágen</h2>  
            </div>
            <hr>
            <div class="flex">
                <i class="fas fa-barcode mt-1 mr-2"></i>
                <h2 class="text-lg inline mt-0">Información del producto</h2>
            </div>
            <div class="flex mt-2 mr-2">
                <div class="w-3/4">
                    <input wire:model="nombre" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombre del producto">
                    <x-input-error for="nombre" />
                </div>
                <div class="w-1/4">
                   
                    <input wire:model="cod_barra" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ml-2" placeholder="Código de barra">
                    <x-input-error for="cod_barra" />
                </div>
            </div>

            <div class="flex justify-between w-full mt-3 mr-2">
                <div class="w-full mr-2">
                    <input wire:model="precio_entrada" type="number" min="0" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio de compra">
                    <x-input-error for="precio_entrada" />
                </div>
                <div class="w-full mr-2">
                    <input wire:model="precio_letal" type="number" min="0" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio de venta unitario">
                    <x-input-error for="precio_letal" />
                </div>
                <div class="w-full">
                    <input wire:model="precio_mayor" type="number" min="0" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio de venta por mayoreo">
                    <x-input-error for="precio_mayor" />
                </div>
            </div>

            <div class="flex justify-between w-full mt-3">
                <div class="w-full mr-2">
                    {{-- <select id="serial" wire:model="serial" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="serial">
                        <option value="1" selected>Con seriales</option>
                        <option value="2">Sin seriales</option>
                    </select>
                    <x-input-error for="serial" /> --}}

                    <select wire:model.lazy="categoria_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Seleccione la categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="categoria_id" />
                </div>
                <div class="w-full mr-2">
                        <select wire:model.lazy="marca_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Seleccione la marca</option>
                            @foreach ($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="marca_id" />
                </div>
                <div class="w-full">
                        <select wire:model.lazy="modelo_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Seleccione el modelo</option>
                            @foreach ($modelos as $modelo)
                                <option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="modelo_id" />
                </div>
            </div>

            <hr class="mb-2">

            <div class="flex">
                <i class="fas fa-luggage-cart mt-1 mr-2"></i>
                <h2 class="text-lg">Cantidad a registrar y valor en puntos</h2>
            </div>

            <div class="flex w-full mt-3 mr-2">
                <div class="w-1/4 mr-2">
                    <input wire:model="cantidad" type="number" min="0" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cantidad">
                    <x-input-error for="cantidad" />
                </div>

                {{-- <div class="w-full mr-2">
                    <input wire:model="inventario_min" type="number" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Stock minimo">
                    <x-input-error for="inventario_min" />
                </div> --}}
                {{-- <div class="w-full"> --}}
                    {{-- <input wire:model="percepcion" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="percepcion">
                    <x-input-error for="percepcion" /> --}}
                    {{-- <select wire:model.lazy="presentacion" id="presentacion" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="presentacion">
                        <option value="" selected>Seleccione la presentación</option>
                        <option value="1">Unidades</option>
                        <option value="2">Juegos</option>
                        <option value="3">Kilogramos</option>
                        <option value="4">Gramos</option>
                        <option value="5">Litros</option>
                        <option value="6">Metros</option>
                        <option value="7">Atados</option>
                    </select>
                    <x-input-error for="presentacion" />
                </div> --}}
                <div class="w-1/4">
                    <input wire:model="puntos" type="number" min="0" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Puntos">
                <x-input-error for="puntos" />
                </div>

            </div>

            <hr class="mb-2">

            


          

         
            {{-- <div class="flex mt-4">
                <i class="fas fa-history mt-3 mr-2"></i>
                <h2 class="text-lg inline mt-2 underline decoration-gray-400">Garantia de fabrica y puntos</h2>
            </div>

            <div class="flex justify-start w-full mt-3">
                <div class="W-1/4 mr-2">
                    <select id="tipo_garantia" wire:model.lazy="tipo_garantia" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                        <option value="" selected>Unidad de tiempo</option>
                        <option value="1">N/A</option>
                        <option value="2">Semanas</option>
                        <option value="3">Mes</option>
                        <option value="4">Meses</option>
                        <option value="5">Ano</option>
                        <option value="6">Anos</option>
                    </select>
                    <x-input-error for="tipo_garantia" />
                </div>

                <div class="W-1/4 mr-2">
                    <input wire:model="garantia" type="number" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Tiempo de garantia">
                    <x-input-error for="garantia" />

                </div>

             
            </div> --}}
      
            <div class="flex ">
                <i class="fas fa-truck-loading mt-1 mr-2"></i>
                <h2 class="text-lg inline mt-0">Proveedor e información de almacenamiento</h2>
            </div>

            <div class="flex justify-start w-full mt-3">
                <div class="w-full mr-2">
                    <select wire:model.lazy="proveedor_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Seleccione el proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{$proveedor->id}}">{{$proveedor->nombre_proveedor}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="proveedor_id" />
                </div> 
                {{-- <div class="w-1/4 mr-2">
                    <select wire:model="categoria_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Seleccione la categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                    <x-input-error for="categoria_id" />
                </div> --}}
                <div class="w-full mr-2">
                    @if ($limitacion_sucursal)
                        <select wire:model.lazy="sucursal_id" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Seleccione el almacen</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" readonly value="Sucursal {{$sucursal_nombre}}" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                    @endif   
                    <x-input-error for="sucursal_id" />
                </div>
                <div class="w-full">
                  
                    <select id="estado" wire:model.lazy="estado" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="estado">
                        <option value="" selected>Estado del producto</option>
                        <option value="1">Habilitado</option>
                        <option value="2">Deshabilitado</option>
                    </select>
                    <x-input-error for="estado" />
                </div>
            </div>

            <div>
                <textarea wire:model="observaciones" class="mt-2 resize-none rounded-md outline-none w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="observaciones" cols="80" rows="2" required placeholder="Observaciones"></textarea>
                <x-input-error for="observaciones" />
            </div>

            <hr class="mb-2">
         
             <div class="flex">
                <i class="far fa-image mt-1 mr-2"></i>
                <h2 class="text-lg inline mt-0">Foto o imagen del producto</h2>
            </div> 
              <div class="row">
                <div class="col">
                    <div class="w-50 h-50">         
                        @if ($file)
                        <img src="{{ $file->temporaryUrl() }}" width="75%" height="75%">
                        @endif
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="file" wire:model="file" id="file" class="block w-full py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" accept="image/*">
                        @error('file')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <p>Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo 3MB. Resolución recomendada 300px X 300px o superior.</p>
                    </div>
                </div>
            </div>   

             {{-- <div class="row">
                <div class="col">
                    <div class="w-50 h-50">         
                        
                        <img id="picture" src="https://cdn.pixabay.com/photo/2020/12/13/16/21/stork-5828727_960_720.jpg" alt="">
                     
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="file" id="file" class="form-control-file" accept="image/*">
                        @error('file')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere repudiandae eius obcaecati ipsam error quas? Explicabo maiores sapiente recusandae, odio accusamus amet saepe error, deleniti doloribus expedita et natus consequuntur.</p>
                    </div>
                </div>
            </div>  --}}

            <hr>


       
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" wire:click="save">
                    <i class="fas fa-file-download"></i> Guardar
                </button>
                <a href="{{route('productos.productos.index')}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a>
            </div>
        </div>
    </div>
</div>



        





