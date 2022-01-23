<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese la fecha de la venta a buscar" class="form-control">
        </div>
        @if ($ventas->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Estado de entrega</th>
                            <th>Total de venta</th>
                            <th>Total pagado</th>
                            <th>Deuda</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{$venta->fecha}}</td>
                                <td>{{$venta->cliente->nombre}} {{$venta->cliente->apellido}}</td>
                                <td>{{$venta->estado_entrega}}</td>
                                <td>{{$venta->total}}</td>
                                <td>{{$venta->total_pagado_cliente}}</td>
                                <td>{{$venta->deuda_cliente}}</td>
                                <td width="10px">
                                    {{-- @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id)) --}}
                                     <a href="#" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></a>
                                </td>
                                <td width="10px">
                                    {{-- @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id)) --}}
                                     <a href="#" class="btn btn-info btn-sm"><i class="fas fa-file-invoice"></i></a>
                                </td>
                                <td width="10px">
                                    {{-- @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id)) --}}
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
