<div>
        <div class="card">
         
            @if ($movimientos->count())
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                           
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Tipo de movimiento</th>
                                <th class="text-center">Detalle</th>
                                <th class="text-center">Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movimientos as $movimiento)
                                <tr>
                                
                                    <td class="text-center">{{$movimiento->fecha}}</td>
                                    <td class="text-center">{{$movimiento->tipo_movimiento}}</td>
                                    <td class="text-center">{{$movimiento->observacion}}</td>
                                    <td class="text-center">{{$movimiento->user->name}} {{$movimiento->user->apellido}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$movimientos->links()}}
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
            <div class="mt-2 ml-4 mb-2">
                <a href="{{route('movimientos.historial')}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a>
            </div>
</div>
