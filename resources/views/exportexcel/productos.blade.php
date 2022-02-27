
<p class="text-gray-500 text-md font-bold bg-white text-center rounded shadow-lg border h-8"> REPORTE DE PRODUCTOS A FECHA {{$fecha_actual}}</p>
    <table class="table table-striped w-full">
        <thead>
            <tr class="text-gray-500 text-md font-bold bg-white rounded shadow-lg border h-8">
                <th>Nombre</th>
                <th>Código de barra</th>
                <th>Precio letal</th>
                <th>Precio al mayor</th>
                <th>Cantidad</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Modelo</th>
                {{-- <th>Tipo de garantia</th>
                <th>Garantia</th>
                <th>Presentación</th>
                <th>Inventario mínimo</th> --}}
                <th>Observaciones</th>

            </tr>
        </thead>
        <tbody>
            
            @foreach ($productos as $producto)
                <tr class="py-2 border-collapse border border-gray-300">
                    @if ($relacion == 'sql')
                        <?php
                          /*  if($producto['tipo_garantia']  == "1") $tipo_garantia = "N/A";
                            elseif($producto['tipo_garantia']  == "2") $tipo_garantia = "SEMANAS";
                            elseif($producto['tipo_garantia']  == "3") $tipo_garantia = "MES";
                            elseif($producto['tipo_garantia']  == "4") $tipo_garantia = "MESES";
                            elseif($producto['tipo_garantia']  == "5") $tipo_garantia = "AÑO";
                            elseif($producto['tipo_garantia']  == "6") $tipo_garantia = "AÑOS";

                            if($producto['presentacion']  == "1") $presentacion = "UNIDADES";
                            elseif($producto['presentacion'] == "2") $presentacion = "JUEGOS";
                            elseif($producto['presentacion'] == "3") $presentacion = "KILOGRAMOS";
                            elseif($producto['presentacion']  == "4") $presentacion = "GRAMOS";
                            elseif($producto['presentacion']  == "5") $presentacion = "LITROS";
                            elseif($producto['presentacion']  == "6") $presentacion = "METROS";
                            elseif($producto['presentacion']  == "7") $presentacion = "ATADOS";*/
                        ?>

                        <td class="py-2 text-center">{{$producto['nombre']}}</td>
                        <td class="text-center font-bold">{{$producto['cod_barra']}} </td>
                        <td class="text-center font-bold">{{$producto['precio_letal']}} </td>
                        <td class="text-center font-bold">{{$producto['precio_mayor']}} </td>
                        <td class="text-center font-bold">{{$producto['quantity']}} </td>
                        <td class="text-center font-bold">{{($producto['categoria_id'])}} </td>
                        <td class="text-center font-bold">{{$producto['marca_id']}} </td>
                        <td class="text-center font-bold">{{$producto['modelo_id']}} </td>
                        {{-- <td class="text-center font-bold">{{$tipo_garantia}} </td>
                        <td class="text-center font-bold">{{$producto['garantia']}} </td>
                        <td class="text-center font-bold">{{$presentacion}} </td> 
                        <td class="text-center font-bold">{{$producto['inventario_min']}} </td>--}}
                        <td class="text-center font-bold">{{$producto['observaciones']}} </td>
                        
                    @else
                        @if ($sucursal != 0)
                            <?php
                               /* if($producto->tipo_garantia == '1') $tipo_garantia = "N/A";
                                elseif($producto->tipo_garantia == '2') $tipo_garantia = "SEMANAS";
                                elseif($producto->tipo_garantia == '3') $tipo_garantia = "MES";
                                elseif($producto->tipo_garantia == '4') $tipo_garantia = "MESES";
                                elseif($producto->tipo_garantia == '5') $tipo_garantia = "AÑO";
                                elseif($producto->tipo_garantia == '6') $tipo_garantia = "AÑOS";

                                if($producto->presentacion == '1') $presentacion = "UNIDADES";
                                elseif($producto->presentacion == '2') $presentacion = "JUEGOS";
                                elseif($producto->presentacion == '3') $presentacion = "KILOGRAMOS";
                                elseif($producto->presentacion == '4') $presentacion = "GRAMOS";
                                elseif($producto->presentacion == '5') $presentacion = "LITROS";
                                elseif($producto->presentacion == '6') $presentacion = "METROS";
                                elseif($producto->presentacion == '7') $presentacion = "ATADOS";*/
                            ?>
                            <td class="py-2 text-center">{{$producto->nombre}}</td>
                            <td class="text-center font-bold">{{$producto->cod_barra}} </td>
                            <td class="text-center font-bold">{{$producto->precio_letal}} </td>
                            <td class="text-center font-bold">{{$producto->precio_mayor}} </td>
                            <td class="text-center font-bold">{{$producto->sucursals->find($sucursal)->pivot->cantidad}} </td>
                            <td class="text-center font-bold">{{$producto->categoria->nombre}} </td>
                            <td class="text-center font-bold">{{$producto->marca->nombre}} </td>
                            <td class="text-center font-bold">{{$producto->modelo->nombre}} </td>
                            {{-- <td class="text-center font-bold">{{$tipo_garantia}} </td>
                            <td class="text-center font-bold">{{$producto->garantia}} </td>
                            <td class="text-center font-bold">{{$presentacion}} </td>
                            <td class="text-center font-bold">{{$producto->inventario_min}} </td> --}}
                            <td class="text-center font-bold">{{$producto->observaciones}} </td>
                            
                        @else
                            <?php
                              /*  if($producto->producto->tipo_garantia == '1') $tipo_garantia = "N/A";
                                elseif($producto->producto->tipo_garantia == '2') $tipo_garantia = "SEMANAS";
                                elseif($producto->producto->tipo_garantia == '3') $tipo_garantia = "MES";
                                elseif($producto->producto->tipo_garantia == '4') $tipo_garantia = "MESES";
                                elseif($producto->producto->tipo_garantia == '5') $tipo_garantia = "AÑO";
                                elseif($producto->producto->tipo_garantia == '6') $tipo_garantia = "AÑOS";

                                if($producto->producto->presentacion == '1') $presentacion = "UNIDADES";
                                elseif($producto->producto->presentacion == '2') $presentacion = "JUEGOS";
                                elseif($producto->producto->presentacion == '3') $presentacion = "KILOGRAMOS";
                                elseif($producto->producto->presentacion == '4') $presentacion = "GRAMOS";
                                elseif($producto->producto->presentacion == '5') $presentacion = "LITROS";
                                elseif($producto->producto->presentacion == '6') $presentacion = "METROS";
                                elseif($producto->producto->presentacion == '7') $presentacion = "ATADOS";*/
                            ?>
                            <td class="py-2 text-center">{{$producto->producto->nombre}}</td>
                            <td class="text-center font-bold">{{$producto->producto->cod_barra}} </td>
                            <td class="text-center font-bold">{{$producto->producto->precio_letal}} </td>
                            <td class="text-center font-bold">{{$producto->producto->precio_mayor}} </td>
                            <td class="text-center font-bold">{{$producto->cantidad}} </td>
                            <td class="text-center font-bold">{{$producto->producto->categoria->nombre}} </td>
                            <td class="text-center font-bold">{{$producto->producto->marca->nombre}} </td>
                            <td class="text-center font-bold">{{$producto->producto->modelo->nombre}} </td>
                            {{-- <td class="text-center font-bold">{{$tipo_garantia}} </td>
                            <td class="text-center font-bold">{{$producto->producto->garantia}} </td>
                            <td class="text-center font-bold">{{$presentacion}} </td>
                            <td class="text-center font-bold">{{$producto->producto->inventario_min}} </td> --}}
                            <td class="text-center font-bold">{{$producto->producto->observaciones}} </td>
                        @endif
                @endif
                </tr>
            @endforeach 
        </tbody>
    </table>