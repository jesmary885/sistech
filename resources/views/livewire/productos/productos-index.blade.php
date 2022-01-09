<div>
    <div>
        <div class="card">
            <div class="card-header">
                <input wire:model="search" placeholder="Ingrese el nombre del producto a buscar" class="form-control">
            </div>
            @if ($productos->count())
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Codigo de Barra</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Stock</th>
                                <th>Precio de compra</th>
                                <th>Precio de venta</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>
                                        @if ($producto->imagen)
                                            <img class="img-rounded" width="30" height="30"  src="{{Storage::url($producto->imagen->url)}}" alt="">
                                        @else
                                            <img class="img-rounded" width="30" height="30"  src="https://cdn.pixabay.com/photo/2020/12/13/16/21/stork-5828727_960_720.jpg" alt="">
                                        @endif
                                    </td>
                                    <td>{{$producto->cod_barra}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->categoria->nombre}}</td>
                                    <td>{{$producto->cantidad}}</td>
                                    <td>{{$producto->precio_entrada}}</td>
                                    <td>{{$producto->precio_letal}}</td>
                                   
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></a>
                                    </td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm"> <i class="fas fa-sitemap"></i></a>
                                    </td>
                                    <td width="10px">
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
