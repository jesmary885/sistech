<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre o nro de documento del proveedor" class="form-control">
        </div>
        @if ($proveedores->count())
            <div class="card-body">
                <table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Proveedor</th>
                            <th class="text-center">Encargado</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Email</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td class="text-center">{{$proveedor->nombre_proveedor}}</td>
                                <td class="text-center">{{$proveedor->nombre_encargado}}</td>
                                <td class="text-center">{{$proveedor->telefono}}</td>
                                <td class="text-center">{{$proveedor->email}}</td>
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


