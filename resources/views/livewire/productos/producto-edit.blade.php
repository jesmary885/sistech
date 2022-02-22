<div>
    <button type="submit" class="btn btn-success btn-sm" wire:click="open" title="Editar producto">
        <i class="fas fa-edit"></i>
   </button> 

   @if($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;"
            wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Producto</h5>
                    </div>
                    <div class="modal-body">
                        <div class="flex">
                            <i class="fas fa-barcode mr-2"></i>
                            <h2 class="text-sm inline underline decoration-gray-400">Información del producto</h2>
                        </div>
                        <div class="flex justify-between w-full">
                            <input wire:model="nombre" type="text" title="Nombre del producto" class="w-full mr-2 px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombre">
                            <x-input-error for="nombre" />
                            <input wire:model="cod_barra" type="text" title="Código de barra" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cód de barra">
                            <x-input-error for="cod_barra" />
                        </div>
                        <div class="flex mt-2 justify-between w-full">
            
                            <input wire:model.defer="precio_letal" name="precio_letal" title="Precio al letal" type="text" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio al detal">
                            <x-input-error for="precio_letal" />
                            <input wire:model="precio_mayor" type="text" title="Precio al mayor" class="w-full px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Precio al mayor">
                            <x-input-error for="precio_mayor" />
                        </div>
                        {{-- <div class="flex mt-2 justify-between w-full">
                            <input wire:model.defer="cantidad" name="cantidad" type="text" title="Cantidad" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cantidad">
                            <x-input-error for="cantidad" />
                            <input wire:model.defer="inventario_min" name="inventario_min" title="Stock minimo" type="text" class="mr-2 px-2 appearance-none block w-full bg-gray-100 text-gray-400 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Stock minimo">
                            <x-input-error for="inventario_min" />
                            <select wire:model="presentacion" id="presentacion" title="Presentación" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="presentacion">
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
                        </div> --}}
                        <div class="flex mt-2 justify-between w-full">
                            <select wire:model="categoria_id" title="Categoría" class="mr-1 block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" selected>Seleccione la categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                            <x-input-error for="categoria_id" />
                            <select wire:model="marca_id" title="Marca" class="mr-1 block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" selected>Seleccione la marca</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                @endforeach
                            </select>
                            <x-input-error for="marca_id" />

                            <select wire:model="modelo_id" title="Modelo" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" selected>Seleccione el modelo</option>
                                @foreach ($modelos as $modelo)
                                    <option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
                                @endforeach
                            </select>
                            <x-input-error for="modelo_id" />
                        </div>
                        <div class="flex mt-3">
                            <i class="fas fa-luggage-cart mr-2"></i>
                            <h2 class="text-sm inline underline decoration-gray-400">Valor en puntos</h2>
                        </div>
                        <div class="w-1/4">
                            <input title="Puntos" wire:model="puntos" type="number" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Tiempo de garantia">
                            <x-input-error for="puntos" />

                        </div>
                            
                      
                        <div class="flex mt-3">
                            <i class="fas fa-truck-loading mr-2"></i>
                            <h2 class="text-sm inline underline decoration-gray-400">Información de almacenamiento</h2>
                        </div>
                        <div class="flex mt-2 justify-between w-full">
                            @if ($limitacion_sucursal)
                                <select wire:model="sucursal_id" title="Sucursal" class="mr-2 block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="" selected>Seleccione el almacen</option>
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" readonly value="Sucursal {{$sucursal_nombre}}" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                            @endif   
                                <x-input-error for="sucursal_id" />
                                <select id="estado" wire:model="estado" title="Estado del producto" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="estado">
                                    <option value="" selected>Estado del producto</option>
                                    <option value="1">Habilitado</option>
                                    <option value="2">Deshabilitado</option>
                                </select>
                                <x-input-error for="estado" />
                        </div>
                        <div class="mt-2">
                            <textarea title="Observaciones" wire:model="observaciones" class="mt-2 mr-3 resize-none rounded-md outline-none px-2 appearance-none block bg-gray-100 text-gray-400 border border-gray-200 py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="observaciones" cols="60" rows="2" required placeholder="Observaciones"></textarea>
                        </div>
                        <div class="flex mt-3">
                            <i class="far fa-image mr-2"></i>
                            <h2 class="text-sm inline underline decoration-gray-400">Foto o imagen del producto</h2>
                        </div>

                        <div class="row ml-3 mr-3">
                                <div class="col">
                                    <div class="w-50 h-50">
                                        @if ($p->imagen)
                                        <img width="75%" height="75%"  src="{{Storage::url($p->imagen->url)}}" alt="">
                                        @else
                                        <img width="75%" height="75%"  src="https://cdn.pixabay.com/photo/2016/07/23/12/54/box-1536798_960_720.png" alt="">
                                        @endif         
                                        @if ($file)
                                        <p class="text-sm inline underline decoration-gray-400 mt-2"> Nueva imagen</p>
                                        <img src="{{ $file->temporaryUrl() }}" width="75%" height="75%">
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" value="file" wire:model="file" id="file" class="block w-full py-1.5 text-sm font-normal text-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" accept="image/*">
                                        @error('file')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                        <p class="text-sm text-gray-400">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere repudiandae eius obcaecati ipsam error quas? Explicabo maiores sapiente recusandae, odio accusamus amet saepe error, deleniti doloribus expedita et natus consequuntur.</p>
                                    </div>
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