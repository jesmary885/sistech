
<p class="text-gray-500 text-md font-bold bg-white text-center rounded shadow-lg border h-8"> KARDEX </p>
<p>Periodo:  {{$fecha_inicio}}  /  {{$fecha_fin}} </p>
<table class="table table-striped w-full">
    <thead>
        <tr class="text-gray-500 text-md font-bold bg-white rounded shadow-lg border h-8">
            <th class="text-center">Producto (Nombre / Cat / Mod / Marc)</th>
            <th class="text-center">U. Entrada</th>
            <th class="text-center">C.U Entrada</th>
            <th class="text-center">U. Salida</th>
            <th class="text-center">C.U Salida</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($movimientos as $value)
            <tr class="py-2 border-collapse border border-gray-300">
                <td class="text-center">{{$value['nombre']}} {{$value['categoria_nombre']}} {{$value['modelo_nombre']}} {{$value['marca_nombre']}}</td>
                <td class="text-center">{{$value['quantity_entrada']}}</td>
                <td class="text-center">{{$value['precie_entrada']}}</td>
                <td class="text-center">{{$value['quantity_salida']}}</td>
                <td class="text-center">{{$value['precie_salida']}}</td>
            </tr>
        @endforeach 
    </tbody>
</table>