<div>
        <div class="card">
            @if ($productos_seriales->count())
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="cursor-pointer text-center text-m font-medium text-gray-700 uppercase tracking-wider"
                                wire:click="order('id')">Id
                                    @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> 
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>  
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>                                    
                                @endif
                                </th>
                                <th class="cursor-pointer text-center text-m font-medium text-gray-700 uppercase tracking-wider"
                                wire:click="order('id')">Serial
                                    @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> 
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>  
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>                                    
                                @endif
                                </th>
                                <th class="cursor-pointer text-center text-m font-medium text-gray-700 uppercase tracking-wider"
                                wire:click="order('id')">Almacen
                                    @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i> 
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>  
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>                                    
                                @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos_seriales as $producto_serial)
                                <tr>
                                    <td class="text-center">{{$producto_serial->id}}</td>
                                    <td class="text-center">{{$producto_serial->serial}}</td>
                                    <td class="text-center">{{$producto_serial->sucursal->nombre}}</td>
                                    <td width="10px">
                                        @livewire('productos.productos-add-serial', ['producto' => $producto_serial],key($producto_serial->id))
                                    </td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer flex">
                    {{$productos_seriales->links()}}
                    <div>
                        <a href="{{route('productos.productos.index')}}" class="btn btn-primary ml-4"><i class="fas fa-undo-alt"></i> Regresar</a>
                    </div>
                    
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>