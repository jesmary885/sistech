<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre o nro de documento del proveedor" class="form-control">
        </div>
        @if ($proveedores->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Encargado</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td>{{$proveedor->nombre_proveedor}}</td>
                                <td>{{$proveedor->nombre_encargado}}</td>
                                <td>{{$proveedor->telefono}}</td>
                                <td>{{$proveedor->email}}</td>
                                <td width="10px">
                                    @livewire('admin.proveedores.proveedor-create',['accion' => 'edit', 'proveedor' => $proveedor->id],key($proveedor->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$proveedor->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$proveedores->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>


