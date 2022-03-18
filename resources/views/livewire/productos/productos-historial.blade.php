<div>
    <div class="card">
     
        @if ($array)
            <div class="card-body">
                <table class="table table-bordered table-responsive-md table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Producto (Nombre / Cat / Mod / Marc)</th>
                            <th class="text-center">U. Entrada</th>
                            <th class="text-center">C.U Entrada</th>
                            <th class="text-center">U. Salida</th>
                            <th class="text-center">C.U Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                                
                        @foreach ($array as $value)
                        <tr>
                            <td class="text-center">{{$value['nombre']}} {{$value['categoria_nombre']}} {{$value['modelo_nombre']}} {{$value['marca_nombre']}}</td>
                            <td class="text-center">{{$value['quantity_entrada']}}</td>
                            <td class="text-center">{{$value['precie_entrada']}}</td>
                            <td class="text-center">{{$value['quantity_salida']}}</td>
                            <td class="text-center">{{$value['precie_salida']}}</td>
                        </tr>
                    @endforeach    
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
           
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
        <div class="flex justify-start">
         
                <div class="mt-2 ml-4 mb-2">
                    <a href="{{route('reportes.index.kardex')}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a>
                </div>
   
            <div>
                <button class="btn btn-success mt-2 ml-2 mb-2" wire:click="export" title="Exportar"> <i class="far fa-file-excel"></i> Exportar reporte</button>
            </div>

        </div>
        
</div>
