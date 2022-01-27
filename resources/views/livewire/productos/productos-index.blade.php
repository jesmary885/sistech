<div>
    <div>
        <div class="card">
            <div class="card-header">
                <input wire:model="search" placeholder="Ingrese el nombre del producto a buscar" class="form-control">
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
                                <th class="text-center">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td align="center">
                                        @if ($producto->imagen)
                                            <img class="img-rounded" width="30" height="30"  src="{{Storage::url($producto->imagen->url)}}" alt="">
                                        @else
                                            <img class="img-rounded" width="30" height="30"  src="https://cdn.pixabay.com/photo/2020/12/13/16/21/stork-5828727_960_720.jpg" alt="">
                                        @endif
                                    </td>
                                    <td class="text-center">{{$producto->cod_barra}}</td>
                                    <td class="text-center">{{$producto->nombre}}</td>
                                    <td class="text-center">@foreach ($sucursales as $sucursal)
                                        {{$sucursal->nombre}} = {{$producto->sucursals->find($sucursal)->pivot->cantidad}} <br>
                                        @endforeach</td>
                                    <td class="text-center">{{$producto->precio_letal}}</td>
                                   
                                    <td width="10px">
                                        @livewire('productos.productos-add', ['producto' => $producto],key($producto->id))
        
                                    </td>
                                    {{-- <td width="10px">
                                        <a href="{{route('productos.productos.edit',$producto)}}" class="btn btn-info btn-sm"> <i class="fas fa-sitemap"></i></a>
                                    </td> --}}
                                    <td width="2px">
                                        <a href="#" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
