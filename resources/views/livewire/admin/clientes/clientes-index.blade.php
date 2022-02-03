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
                            <th>Nombre</th>
                            <th>Nro de documento</th>
                            <th>Telefono</th>
                            <th>@livewire('admin.clientes.clientes-create',['vista' => 'clientes','accion' => 'create'])</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->nombre}} {{$cliente->apellido}}</td>
                                <td>{{$cliente->nro_documento}}</td>
                                <td>{{$cliente->telefono}}</td>
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

