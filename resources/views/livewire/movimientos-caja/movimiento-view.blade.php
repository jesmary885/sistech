<div>

    <div class="card">
        <div class="card-header flex items-center justify-between">
            <div class="flex-1">
                <input wire:model="search" placeholder="Ingrese " class="form-control">
            </div>
            <div class="ml-2">
                <button
                title="Ayuda a usuario"
                class="btn btn-success btn-sm" 
                wire:click="ayuda"><i class="fas fa-info"></i>
                Guía rápida
            </button>
            </div>
            <div class="ml-2">
                @livewire('movimientos-caja.movimiento-new',['sucursal' => $sucursal]) 
            </div>

        </div>
        @if ($movimientos->count())
            <div class="card-body">
                <table class="table table-striped table-responsive table-responsive-sm table-responsive-md ">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Fecha y hora</th>
                            <th class="text-center">Tipo de movimiento</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Detalle</th>
                            <th class="text-center">Usuario</th>
                            <th colspan="2"></th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $movimiento)
                            <tr>
                                <td class="text-center">{{$movimiento->fecha}}</td>
                                <td class="text-center">{{$movimiento->tipo_movimiento}}</td>
                                <td class="text-center">{{$movimiento->cantidad}}</td>
                                <td class="text-center">{{$movimiento->user->name}} {{$movimiento->user->apellido}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
            <div class="card-footer">
                {{$movimientoss->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>
