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
                            <th class="text-center">Codigo de Barra</th>
                            <th class="text-center">Descripcion</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td class="text-center">{{ $producto->cod_barra }}</td>
                                <td class="text-center">{{ $producto->nombre }}</td>
                                <td class="text-center">{{ $producto->precio_letal}}</td>
                                <td class="text-center"><?php 
                                    $cantidad= $producto->sucursals->find($sucursal)->pivot->cantidad;
                                    if ($cantidad==0) $estado = 'disabled';
                                    else $estado = '';
                                    ?>
                                    {{ $cantidad }}</td>
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

                <div class="ml-4">
                    <a href="{{route('ventas.ventas.show',$sucursal)}}" class="btn btn-info">Continuar</a>
                </div>

            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
