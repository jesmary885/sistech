<div class="grid lg:grid-cols-4 gap-6">
    <aside class="lg:col-span-3">
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <div class="flex-1">
                    <div class=flex>
                        <div class="w-1/4">
                            <select wire:model="buscador" id="buscador" class="form-control text-m" name="buscador">
                                <option value="0">Código de barra</option>
                                <option value="1">serial</option>
                                <option value="2">Marca</option>
                                <option value="3">Modelo</option>
                            </select>
        
                            <x-input-error for="buscador" />
    
                        </div>
                        <input wire:model="search" placeholder="Ingrese el detalle del producto a buscar" class="form-control ml-2">
                            
                    </div>
                    
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
                    <table class="table table-bordered table-responsive-md table-responsive-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Cód</th>
                                <th class="text-center">Serial</th>
                                <th class="text-center">Letal</th>
                                <th class="text-center">Mayor</th>
                                <th colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <?php
                                        $cant = 0;
                                        foreach($sucursales as $sucursale){
                                            $cant = $cant + $producto->producto->sucursals->find($sucursale)->pivot->cantidad;
                                        }
                                    ?>
                                  
                                    <td class="text-center">{{$producto->producto->nombre}} {{$producto->producto->marca->nombre}} {{$producto->producto->modelo->nombre}} @livewire('productos.productos-stock-sucursal', ['producto' => $producto->producto, 'cant' => $cant],key(0.,'$producto->producto->id'))</td>
                                    <td class="text-center">{{ $producto->cod_barra }}</td>
                                    <td class="text-center">{{ $producto->serial }}</td>
                                    <td class="text-center">{{ $producto->producto->precio_letal}}</td>
                                    <td class="text-center">{{ $producto->producto->precio_mayor}}</td>
                                
                                    
                                    
                                    <td width="10px">
                                        @livewire('ventas.ventas-seleccion-cantidades', ['producto' => $producto,'sucursal' => $sucursal],key($producto->id))
                                        {{-- <a href="#" class="btn btn-info btn-sm {{$estado}}"><i class="fas fa-check"></i></a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex card-footer">
                    {{ $productos->links()}}
    
                    <div class="ml-2 flex">
                        <div>
                            <a href="{{route('ventas.ventas.index')}}" class="btn btn-primary"><< Regresar</a>
                           
                        </div>
                        <div class="ml-2">
                            <a href="{{route('facturacion',['sucursal'=>$sucursal ,'proforma'=>$proforma])}}" class="btn btn-primary">Continuar >></a>
                            
                        </div>
                      
                        
                    </div>
    
                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros</strong>
                    <div class="mt-4">
                        <a href="{{route('ventas.ventas.index')}}" class="btn btn-primary"><< Regresar</a>
    
                    </div>
                    
                </div>
            @endif
    
        </div>

    </aside>

    <div class="card lg:col-span-1">
        @livewire('ventas.ventas-cart', ['sucursal' => $sucursal])

    </div>
    
</div>
