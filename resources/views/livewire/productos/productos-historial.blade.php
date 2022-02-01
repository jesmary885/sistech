<div>
    <div>
        <div class="card mt-2">
            <p class="text-gray-700 mt-4 ml-4 font-semibold">Ingrese el periodo de fechas en que desee realizar la busqueda:</p>
            <div class="flex justify-items-stretch w-full mt-3 mb-2 ml-4">
                <div>
                    <x-input.date wire:model.lazy="fecha_inicio" id="fecha_inicio" placeholder="Seleccione la fecha inicio" class="px-4 outline-none"/>
                    <x-input-error for="fecha_inicio"/>     
                </div>
                <p class="ml-2 mr-2 text-gray-700 font-semibold">-</p>
                <div>
                    <x-input.date wire:model.lazy="fecha_fin" id="fecha_fin" placeholder="Seleccione la fecha fin" class="px-4 outline-none"/>
                    <x-input-error for="fecha_fin"/>
                </div>
            </div>
        </div>
        <div class="card">
 
            <div class="card-header">
                <input wire:model="search" placeholder="Ingrese el nombre o código de barra del producto a buscar" class="form-control">
            </div>
            @if ($productos->count())
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Código de Barra</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Stock general</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-center">{{$producto->cod_barra}}</td>
                                    <td class="text-center">{{$producto->nombre}}</td>
                                    <td class="text-center">{{$producto->precio_letal}}</td>
                                    <td width="10px">
                                        <button
                                        class="ml-4 btn btn-primary btn-sm" 
                                        wire:click="select_product('{{$producto->id}}}')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$productos->links()}}
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
    </div>
</div>
