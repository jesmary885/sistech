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
                                    <td><img class="img-rounded" width="30" height="30" src="{{$producto->imagen}}" alt=""></td>
                                    <td>{{$producto->cod_barra}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->categoria->nombre}}</td>
                                    <td>{{$producto->cantidad}}</td>
                                    <td>{{$producto->precio_entrada}}</td>
                                    <td>{{$producto->precio_letal}}</td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-primary btn-sm">Agregar</a>
                                    </td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                    </td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
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
