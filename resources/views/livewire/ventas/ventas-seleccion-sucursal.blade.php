<div>
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg text-gray-600">Seleccione la sucursal en donde realizara la venta</h2>
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
                                    <a href="{{route('ventas.ventas.edit',$sucursal)}}" class="btn btn-info btn-sm"><i class="fas fa-check"></i></a>
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
