<div>
    <div>
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <div class="flex-1">
                    <input wire:model="search" placeholder="Ingrese el nombre o código de barra del producto a buscar" class="form-control">
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
            @if ($productos->count())
                <div class="card-body">
                    <table class="table table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Código</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">letal</th>
                                <th class="text-center">mayor</th>
                                <th class="text-center">Puntos</th>
                                <th colspan="4"></th>
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
                                    <td class="text-justify">{{$producto->categoria->nombre}} {{$producto->marca->nombre}} {{$producto->modelo->nombre}}</td>
                                    <?php
                                        $cant = 0;
                                        foreach($sucursales as $sucursal){
                                            $cant = $cant + $producto->sucursals->find($sucursal)->pivot->cantidad;
                                        }
                                    ?>
                                    <td class="text-center">@livewire('productos.productos-stock-sucursal', ['producto' => $producto, 'cant' => $cant],key(0.,'$producto->id')) </td>
                                        {{-- <b>{{$sucursal->nombre}}</b> = {{$producto->sucursals->find($sucursal)->pivot->cantidad}}, --}}
                                    <td class="text-center">{{$producto->precio_letal}}</td>
                                    <td class="text-center">{{$producto->precio_mayor}}</td>
                                    <td class="text-center">{{$producto->puntos}}</td>
                                    
                                        
                                    <td width="10px">
                                        @livewire('productos.productos-add', ['producto' => $producto],key(02.,'$producto->id'))
                                    </td>
                                    <td width="10px">
                                         @livewire('productos.producto-edit', ['producto' => $producto],key(01.,'$producto->id'))
                                    </td>
                                    <td width="10px">
                                        @livewire('productos.productos-barcode', ['producto' => $producto],key(011.,'$producto->id'))
                                   </td>
                                    <td width="10px">
                                        <button
                                            class="btn btn-danger btn-sm" 
                                            wire:click="delete('{{$producto->id}}')"
                                            title="Eliminar equipo">
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
