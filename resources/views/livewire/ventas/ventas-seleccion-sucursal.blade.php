<div>
    <div class="card">
        <div class="card-header">
            @if ($vista == 'ventas')
                <h2 class="text-lg text-gray-600">Seleccione la sucursal en donde realizara la venta</h2>
            @elseif($vista == 'productos')
            <h2 class="text-lg text-gray-600">Seleccione la sucursal donde esta el producto a trasladar</h2>
            @else <h2 class="text-lg text-gray-600">Seleccione el almacen</h2>
            @endif
            
        </div>
        @if ($sucursales->count())
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Sucursal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sucursales as $sucursal)
                            <tr>
                                <td class="text-center">{{ $sucursal->id }}</td>
                                <td class="text-center">{{ $sucursal->nombre}}</td>
                                <td width="10px">
                                    @if ($vista == 'ventas')
                                        <a href="{{route('ventas.ventas.edit',$sucursal)}}" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
                                    @elseif($vista == 'productos')
                                        <a href="{{route('productos.traslado.select',$sucursal)}}" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
                                    @else
                                        <a href="{{route('productos.serial.view',$sucursal)}}" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>
</div>
