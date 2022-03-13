<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
    <aside class="md:col-span-1 lg:col-span-2">
        <div class="card">
            <h5 class="modal-title ml-4 mt-2 text-md text-gray-800"> <i class="fas fa-boxes"></i>  Disponibles en almacen</h5>
            <hr class="m-0 ">
            <div class="card-header">
                <div class="mt-2 w-3/4">
                    <select wire:model="sucursal_id" class="block bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" selected>Sucursal destino</option>
                            @foreach ($sucursales as $sucursale)
                                <option value="{{$sucursale->id}}">{{$sucursale->nombre}}</option>
                            @endforeach
                    </select>    
                    <x-input-error for="sucursal_id" />
                </div>
            </div>

            
            
            @if ($productos->count())
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <input wire:model="search" placeholder="Ingrese el serial del producto a buscar" class="form-control mb-2">
                        </div>
                        <div class="ml-2">
                            <button
                                title="Ayuda a usuario"
                                class="btn btn-success btn-sm" 
                                wire:click="ayuda"><i class="fas fa-info"></i>
                                Guía rápida
                            </button>
                        </div>

                    </div>

                    <table class="table table-bordered table-responsive-lg table-responsive-md table-responsive-sm" >
                        <thead class="thead-dark">
                            <tr>
                            <th>Producto</th>
                            <th>Serial</th>
                            <th colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                <td>{{$producto->producto->nombre}} {{$producto->producto->marca->nombre}} {{$producto->producto->modelo->nombre}}</td>
                                <td>{{$producto->serial}}</td>
                                <td width="10px"><input type="checkbox" wire:model="prod.{{$producto->id}}" value="{{$producto->id}}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$productos->links()}}
                </div>

                <div class="flex mt-2 mb-2 ml-4">
                    <button type="button" class="btn btn-primary disabled:opacity-25 mr-2" wire:loading.attr="disabled" wire:click="save">Enviar</button>
                    <a href="{{route('productos.traslado.select',$sucursal)}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a> 
                </div>

            @else
                <div class="card-body">
                    <strong>No hay registros</strong> <br>
                    <hr>
                    <a href="{{route('productos.traslado.select',$sucursal)}}" class="btn btn-primary mt-4"><i class="fas fa-undo-alt"></i> Regresar</a>
                </div>
            @endif
        </div>
    </aside>

    <div class="card md:col-span-1 lg:col-span-2">
        @livewire('productos.productos-detalle-traslado-recibir', ['sucursal' => $sucursal])
    </div>
</div>

