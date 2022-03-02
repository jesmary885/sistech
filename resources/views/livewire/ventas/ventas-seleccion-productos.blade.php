<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre o Cod. de barra del producto a buscar"
                class="form-control">
        </div>
        @if ($productos->count())
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Codigo de Barra</th>
                            <th class="text-center">Serial</th>
                            <th class="text-center">Precio letal</th>
                            <th class="text-center">Precio mayor</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td class="text-center">{{ $producto->producto->nombre }}</td>
                                <td class="text-center">{{ $producto->cod_barra }}</td>
                                <td class="text-center">{{ $producto->serial }}</td>
                                <td class="text-center">{{ $producto->producto->precio_letal}}</td>
                                <td class="text-center">{{ $producto->sucursal_id}}</td>
                                
                                <td width="10px">
                                    @livewire('ventas.ventas-seleccion-cantidades', ['producto' => $producto,'sucursal' => $sucursal],key($producto->id))
                                    {{-- <a href="#" class="btn btn-info btn-sm {{$estado}}"><i class="fas fa-check"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex card-footer">
                {{ $productos->links()}}

                <div class="ml-2 flex">
                    <div>
                        <a href="{{route('ventas.ventas.index')}}" class="btn btn-primary"><< Regresar</a>
                       
                    </div>
                    <div class="ml-2">
                        <a href="{{route('ventas.ventas.show',$sucursal)}}" class="btn btn-primary">Continuar >></a>
                        

                    </div>
                  
                    
                </div>

            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
                <div class="mt-4">
                    <a href="{{route('ventas.ventas.index')}}" class="btn btn-primary"><< Regresar</a>

                </div>
                
            </div>
        @endif

    </div>
</div>
