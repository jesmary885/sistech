<div>
    <h5 class="modal-title ml-4 mt-2 text-md text-gray-800"> <i class="fas fa-dolly"></i>  Pendientes por recibir</h5>
        <hr class="m-0 ">
        
        <div class="card-header">
            <div class="mt-10 w-3/4">     
            </div>     
        </div>
      
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <input wire:model="search2" placeholder="Ingrese el serial del producto a buscar" class="form-control mb-2">
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
                @if ($trasl->count())
              
                <table class="table table-bordered table-responsive-lg table-responsive-md table-responsive-sm" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Serial</th>
                            <th colspan="1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trasl as $p)
                            <tr>
                            <td>{{$p->productoSerialSucursal->producto->nombre}} {{$p->productoSerialSucursal->producto->marca->nombre}} {{$p->productoSerialSucursal->producto->modelo->nombre}}</td>
                            <td>{{$p->productoSerialSucursal->serial}}</td>
                            <td width="10px"><input type="checkbox" wire:model="prodr.{{$p->id}}" value="{{$p->productoSerialSucursal->serial}}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-input-error for="prodr" />
            </div>
            <div class="card-footer">
                {{$trasl->links()}}
            </div>

            <div class="flex mt-2 mb-2 ml-4">
                <button type="button" class="btn btn-primary disabled:opacity-25 mr-2" wire:loading.attr="disabled" wire:click="ingresar">Ingresar</button>
            </div>

        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
</div>
