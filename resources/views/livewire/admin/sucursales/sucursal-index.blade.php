<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre de la sucursal a buscar" class="form-control">
        </div>
        @if ($sucursales->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Dirección</th>
                            <th>Telefono</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sucursales as $sucursal)
                            <tr>
                                <td>{{$sucursal->nombre}}</td>
                                <td>{{$sucursal->direccion}}</td>
                                <td>{{$sucursal->telefono}}</td>
                                <td width="10px">
                                    @livewire('admin.sucursales.sucursal-create',['accion' => 'edit', 'sucursal' => $sucursal->id],key($sucursal->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$sucursal->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$sucursales->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>



