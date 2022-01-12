<div>
    <div class="grid grid-cols-2 gap-2">
        <aside>
            <div class="card">
                <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el nombre del producto a buscar" class="form-control">
                </div>
                @if ($productos->count())
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td class="text-center">{{$producto->cod_barra}}</td>
                                        <td class="text-center">{{$producto->nombre}}</td>
                                        <td width="10px">
                                            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$productos->links()}}
                    </div>
                @else
                     <div class="card-body">
                        <strong>No hay registros</strong>
                    </div>
                @endif
            </div>
        </aside> 

        <div class="grid col-span-1">
            <div class="card">
                <div class="card-body">
                    <div class="flex">
                        <i class="fas fa-barcode mt-3 mr-2"></i>
                        <h2 class="text-lg inline mt-2 underline decoration-gray-400">Datos de la venta y cliente</h2>
                    </div>
                    <div class="flex mt-2 mr-2">
                        <div class="w-3/4">
                            <input wire:model="nombre" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nombre del producto">
                            <x-input-error for="nombre" />
                        </div>
                        <div class="w-1/4">
                           
                            <input wire:model="cod_barra" type="text" class="px-2 appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ml-2" placeholder="Código de barra">
                            <x-input-error for="cod_barra" />
                        </div>
                    </div>
        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            
                <button type="submit" class="btn btn-primary" wire:click="save">
                    <i class="fas fa-file-download"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>