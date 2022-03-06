<div>
    <div>
        <div class="card">
            <div class="card-header">
                <input wire:model="search" placeholder="Ingrese código de barra del producto a buscar" class="form-control">
            </div>
            @if ($productos->count())
                <div class="card-body">
                    <table class="table table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="text-center" wire:click="order('fecha_compra')">Fecha de compra
                                    @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> 
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>  
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>                                    
                                @endif</th>
                                <th class="text-center">Compra Nro</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Código de Barra</th>
                                <th class="text-center">Serial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-center">{{$producto->fecha_compra}}</td>
                                    <td class="text-center">{{$producto->compra_id}}</td>
                                    <td class="text-center">{{$producto->producto->nombre}}</td>
                                    <td class="text-center">{{$producto->producto->cod_barra}}</td>
                                    <td class="text-center">{{$producto->serial}}</td>

                                    <td width="10px">
                                        @livewire('productos.productos-add-serial', ['producto' => $producto],key($producto->id))
                                    </td>
                                    <td width="10px">
                                        <button
                                            class="btn btn-danger btn-sm" 
                                            wire:click="delete('{{$producto->id}}')"
                                            title="Eliminar producto">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                            
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="flex">
                        {{$productos->links()}}

                    <div class="ml-2 mr-2">
                        <a href="{{route('productos.serial.index')}}" class="btn btn-primary ml-4"><i class="fas fa-undo-alt"></i> Regresar</a>
                    </div>

                    </div>
                    
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
    </div>

</div>
