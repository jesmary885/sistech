<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese nro de documento del cliente a buscar" class="form-control">
        </div>
 
        @if ($ventas->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Cliente - Documento</th>
                            <th class="text-center">Tipo de venta</th>
                            <th class="text-center">Total de venta</th>
                            <th class="text-center">Total pagado</th>
                            <th class="text-center">Deuda</th>
                            <th class="text-center">Estado</th>
                 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                           
                                <td class="text-center">{{$venta->fecha}}</td>
                                <td class="text-center">{{$venta->cliente->nombre}} {{$venta->cliente->apellido}}</td>
                                <td class="text-center">{{$venta->cliente->nro_documento}}</td>
                                @if($venta->tipo_pago == 1)
                                <td class="text-center">CONTADO</td>
                                @else
                                <td class="text-center">CREDITO</td>  
                                @endif
                                <td class="text-center">{{$venta->total}}</td>
                                <td class="text-center">{{$venta->total_pagado_cliente}}</td>
                                <td class="text-center">{{$venta->deuda_cliente}}</td>
                                <td class="text-center">{{$venta->estado}}</td>
                                @if($venta->tipo_pago == 2)
                                    <td width="10px">
                                        @livewire('ventas.ventas-credito-abono', ['venta' => $venta, 'vista' => '1'],key($venta->id)) 
                                    {{-- <a href="#" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></a> --}}
                                    </td>
                                @endif
                                <td width="10px">
                                    @livewire('ventas.ventas-view', ['venta' => $venta],key('0'.' '.$venta->id)) 
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$venta->id}}')"
                                        title="Anular venta">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$ventas->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>
