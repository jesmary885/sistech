<div>
    <div>
        <div class="card">
            <div>
                @if ($productos->count())
                    <div class="card-header">
                        <div class="mt-2 w-3/4">
                            <select wire:model="sucursal_id" class="block bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="" selected>Sucursal destino</option>
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                    @endforeach
                            </select>    
                            <x-input-error for="sucursal_id" />
                        </div>
                       
                    </div>
                    <div class="card-body">
                        <input wire:model="search" placeholder="Ingrese el serial del producto a buscar" class="form-control mb-2">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{$producto->id}}</td>
                                        <td>{{$producto->serial}}</td>
                                        <td width="10px">
                                            <input type="checkbox" wire:model="prod.{{$producto->id}}" value="{{$producto->id}}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$productos->links()}}
                    </div>

                    <div class="flex mt-2 mb-2 ml-4">
                        <button type="button" class="btn btn-primary disabled:opacity-25 mr-2" wire:loading.attr="disabled" wire:click="save">Guardar</button>
                        {{-- <a href="{{route('productos.traslado.select',$sucursal)}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a> --}}
                    </div>

                 @else
                    <div class="card-body">
                        <strong>No hay registros</strong>

                        <a href="{{route('productos.traslado.select',$sucursal)}}" class="btn btn-primary mt-4"><i class="fas fa-undo-alt"></i> Regresar</a>
                    </div>
                 @endif
            </div>



        </div>

    </div>


</div>

