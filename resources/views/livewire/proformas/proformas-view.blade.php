<div>
    <div class="card">
        <div class="card-header flex items-center justify-between">
            <div class="flex-1">
                <input wire:model="search" placeholder="Ingrese el recurso a buscar" class="form-control">
            </div>
            <div class="ml-2">
                <button
                    title="Ayuda a usuario"
                    class="btn btn-success btn-sm" 
                    wire:click="ayuda"><i class="fas fa-info"></i>
                    Guía rápida
                </button>
            </div>
        </div>
        @if ($proformas->count())
            <div class="card-body mt-0">
                <table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Cliente - Documento</th>
                            <th class="text-center">Usuario</th>
  
                            <th colspan="2"></th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proformas as $proforma)
                            <tr>
                                <td class="text-center">{{$proforma->fecha}}</td>
                                <td class="text-center">{{$proforma->cliente->nombre}} {{$proforma->cliente->apellido}}</td>
                                <td class="text-center">{{$proforma->cliente->nro_documento}}</td>
                                <td class="text-center">{{$proforma->user->name}} {{$proforma->user->apellido}}</td>
                                <td width="10px">
                                    @livewire('proformas.proforma-detalle', ['proforma' => $proforma],key($proforma->id))
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$proformas->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>