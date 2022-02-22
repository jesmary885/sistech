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
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Código de Barra</th>
                                <th class="text-center">Descripcion</th>
                                <th class="text-center">Stock general</th>
                                <th class="text-center">Precio letal</th>
                                <th class="text-center">Precio mayor</th>
                                <th class="text-center">Puntos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td align="center">
                                        @if ($producto->imagen)
                                            <img class="img-rounded m-0" width="90" height="90"  src="{{Storage::url($producto->imagen->url)}}" alt="">
                                        @else
                                            <img class="img-rounded m-0" width="90" height="90"  src="https://cdn.pixabay.com/photo/2016/07/23/12/54/box-1536798_960_720.png" alt="">
                                        @endif
                                    </td>
                                    <td class="text-center">{{$producto->cod_barra}}</td>
                                    <td class="text-center">{{$producto->nombre}}</td>
                                    <td class="text-center">@foreach ($sucursales as $sucursal)
                                        {{$sucursal->nombre}} = {{$producto->sucursals->find($sucursal)->pivot->cantidad}} <br>
                                        @endforeach</td>
                                    <td class="text-center">{{$producto->precio_letal}}</td>
                                    <td class="text-center">{{$producto->precio_mayor}}</td>
                                    <td class="text-center">{{$producto->puntos}}</td>
                                    
                                        
                                    <td width="10px">
                                        @livewire('productos.productos-add', ['producto' => $producto],key($producto->id))
                                    </td>
                                    <td width="10px">
                                         @livewire('productos.producto-edit', ['producto' => $producto],key($producto->nombre))
                                    </td>
                                    <td width="10px">
                                        @livewire('productos.productos-barcode', ['producto' => $producto],key($producto->cod_barra))
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
