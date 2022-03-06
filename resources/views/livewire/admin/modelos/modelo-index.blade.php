<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre del modelo a buscar" class="form-control">
        </div>
        @if ($modelos->count())
            <div class="card-body">
                <table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Modelo</th>
                            <th class="text-center">Marca</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modelos as $modelo)
                            <tr>
                                <td class="text-center">{{$modelo->id}}</td>
                                <td class="text-center">{{$modelo->nombre}}</td>
                                <td class="text-center">{{$modelo->marca->nombre}}</td>
                                <td width="10px">
                                    @livewire('admin.modelos.modelo-create',['accion' => 'edit', 'modelo' => $modelo->id],key($modelo->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$modelo->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$modelos->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>
