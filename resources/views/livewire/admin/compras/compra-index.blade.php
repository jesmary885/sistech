<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese la fecha de la compra realizada o nombre del producto a buscar" class="form-control">
        </div>
        @if ($compras->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio de compra</th>
                            <th>Total</th>
                            <th>Sucursal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $compra)
                            <tr>
                                <td>{{$compra->fecha}}</td>
                                <td>{{$compra->producto->nombre}} - Cod. barra: {{$compra->producto->cod_barra}}</td>
                                <td>{{$compra->cantidad}}</td>
                                <td>{{$compra->precio_compra}}</td>
                                <td>{{$compra->total}}</td>
                                <td>{{$compra->sucursal->nombre}}</td>
                                <td width="10px">
                                    @livewire('admin.compras.compras-edit',['compra' => $compra],key($compra->id))
                                </td>
                                <td width="10px">
                                    <button
                                        class="btn btn-danger btn-sm" 
                                        wire:click="delete('{{$compra->id}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$compras->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>