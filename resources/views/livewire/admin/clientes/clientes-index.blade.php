<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre o nro de documento del cliente" class="form-control">
        </div>
        @if ($clientes->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Nro de documento</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Ptos acumulados</th>
                            <th colspan="2"></th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td class="text-center">{{$cliente->nombre}} {{$cliente->apellido}}</td>
                                <td class="text-center">{{$cliente->nro_documento}}</td>
                                <td class="text-center">{{$cliente->telefono}}</td>
                                <td class="text-center">{{$cliente->puntos}}</td>
                                <td width="10px">
                                    @livewire('admin.clientes.clientes-create',['vista' => 'clientes','accion' => 'edit', 'cliente' => $cliente->id],key($cliente->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$cliente->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$clientes->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>

