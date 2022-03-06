<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el nombre de la categoria a buscar" class="form-control">
        </div>
        @if ($categorias->count())
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
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="text-center">{{$categoria->id}}</td>
                                <td class="text-center">{{$categoria->nombre}}</td>
                                <td width="10px">
                                    @livewire('admin.categorias.categoria-create',['accion' => 'edit', 'categoria' => $categoria->id],key($categoria->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$categoria->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$categorias->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>
