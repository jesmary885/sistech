<div>
    <div>
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
                                <th class="text-center">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
            
                                    <td class="text-center">{{$producto->cod_barra}}</td>
                                    <td class="text-center">{{$producto->nombre}}</td>
                                    <td class="text-center">{{$producto->sucursals->find($sucursal)->pivot->cantidad}}</td>                             
                                    <td width="10px">  
                                        @livewire('productos.productos-detalle-traslado', ['producto' => $producto, 'sucursal' => $sucursal],key($producto->id))
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

