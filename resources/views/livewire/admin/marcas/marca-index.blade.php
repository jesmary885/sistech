<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre de la marca a buscar" class="form-control">
        </div>
        @if ($marcas->count())
            <div class="card-body">
                <table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Categoria</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marcas as $marca)
                            <tr>
                                <td class="text-center">{{$marca->id}}</td>
                                <td class="text-center">{{$marca->nombre}}</td>
                                <td width="10px">
                                    @livewire('admin.marcas.marca-create',['accion' => 'edit', 'marca' => $marca->id],key($marca->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$marca->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$marcas->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>
