<div x-data="{ tipo_pago: @entangle('tipo_pago'),siguiente_venta: @entangle('siguiente_venta')}" class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        <div class="bg-white rounded-lg shadow mb-2 pb-2">
            <div>
                <input wire:model="search" placeholder="Ingrese el nombre o nro de documento del cliente" class="form-control">
            </div>
            @if ($clientes->count())
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>@livewire('admin.clientes.clientes-create',['vista' => "ventas"])</th>
        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombre}} {{$cliente->apellido}}</td>
                                    <td>{{$cliente->nro_documento}}</td>
                                    <td width="10px">
                                    <button
                                        class="ml-4 btn btn-primary btn-sm" 
                                        wire:click="select_u('{{$cliente->id}}}')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{$clientes->links()}}
                </div>
            @else
                 <div>
                    <strong>No hay registros</strong>
                </div>
            @endif
           
           
        </div>

            
        <div  class="bg-white rounded-lg shadow mt-2 w-full py-4">

            <div class="flex justify-between w-full h-full">
                <div class="ml-2 mr-2 w-full">
                    <select id="estado_entrega" wire:model="estado_entrega" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                        <option value="" selected>Seleccione el estado de entrega</option>
                        <option value="1">Entregado</option>
                        <option value="2">Por entregar</option>
                    </select>
                    <x-input-error for="estado_entrega" />
                </div>
                <div class="mr-2 w-full">
                    <div class="w-full mr-2">
                        <input wire:model="descuento" type="text" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Descuento en venta %">
                        <x-input-error for="descuento" />
                    </div>
                </div>
            </div>

            <div class="flex justify-between w-full h-full mt-2">
                <div class="ml-2 mr-2 w-full">
                    <select id="metodo_pago" wire:model="metodo_pago" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                        <option value="" selected>Seleccione el metodo de pago</option>
                        <option value="1">Efectivo</option>
                        <option value="2">Tarjeta Credito</option>
                        <option value="3">Tarjeta Debito </option>
                    </select>
                    <x-input-error for="metodo_pago" />
                </div>
                <div class="mr-2 w-full">
                    <select id="tipo_pago" wire:model="tipo_pago" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                        <option value="" selected>Seleccione el tipo de pago</option>
                        <option value="1">Contado</option>
                        <option value="2">Credito</option>
                    </select>
                    <x-input-error for="tipo_pago" />
                </div>
            </div>

            <div class="w-full hidden" :class="{'hidden': tipo_pago != 2}">
                    <div class="w-1/4 m-2">
                        <input wire:model="pago_cliente" type="text" class="w-full px-4 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Total pagado">
                        <x-input-error for="pago_cliente" />
                    </div>
            </div>


        </div>

        <div class="flex" :class="{'hidden': siguiente_venta != 0}">
            <div class="mr-2">
                <a href="{{route('ventas.ventas.show',$sucursal)}}" class="btn mt-6 mb-4 btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a>
            </div>
            <x-button
                wire:loading.attr="disabled"
                wire:target="save"
                class="mt-6 mb-4 mr-2" 
                wire:click="save">
                <i class="fas fa-file-invoice mr-1"></i>
                Facturar
            </x-button>
        </div>
    
        <div :class="{'hidden': siguiente_venta != 1}">
            <x-button
            class="btn btn-primary mt-6 mb-4 mr-2" 
            wire:click="nueva_venta">
            <i class="fas fa-cart-plus"></i>
            Nueva Venta
        </x-button>
            <x-button
                class="btn btn-primary mt-6 mb-4 mr-2" 
                wire:click="inicio">
                <i class="fas fa-fast-backward"></i>
                Ir a inicio
            </x-button>
        </div>

    </div>

    {{-- Productos agregados en el carrito --}}

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="border-b border-gray-200">
                        <article>
                            <h1 class="font-bold mr-4 text-lg text-gray-600">{{$item->name}}</h1>
                            <div class="flex">
                                <p class="mr-2 text-sm font-semibold">Cantidad: {{$item->qty}}</p>
                                <p class="text-sm"> - Precio: S/ {{$item->price}}</p>   

                            </div>
                           
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>


            <div class="text-gray-700">

                <p class="flex justify-between items-center">
                    Cliente: 
                    <span class="font-semibold">{{$cliente_select}}</span>
                </p>

            </div>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Total parcial
                    <span class="font-semibold">S/ {{Cart::subtotal()}}</span>
                </p>
                <p class="flex justify-between items-center">
                    Descuento
                    {{$descuento_total = (Cart::subtotal() * $this->descuento) / 100}}
                    <span class="font-semibold">S/ {{$descuento_total}}</span>
                </p>
                <p class="flex justify-between items-center">
                    Subtotal menos descuento
                    <span class="font-semibold">S/ {{Cart::subtotal() - $descuento_total}}</span>
                </p>
                <p class="flex justify-between items-center">
                    IVA (15%)
                    <span class="font-semibold">
                    S/ {{(Cart::subtotal() - $descuento_total) * (0.15)}}
                    </span>
                </p>


                <div class="hidden" :class="{'hidden': tipo_pago != 2}">
                    <hr class="mt-4 mb-3">
                    <p class="flex justify-between items-center">
                        Total pagado por el cliente
                        <span class="font-semibold">
                        S/ {{$pago_cliente}}
                        </span>
                    </p>
                    <p class="flex justify-between items-center">
                        Pendiente por pagar
                        <span class="font-semibold">
                        S/ {{((Cart::subtotal() - $descuento_total) + ((Cart::subtotal() - $descuento_total) * (0.15))) - $pago_cliente}}
                        </span>
                    </p>
                </div>
                
                <hr class="mt-4 mb-3">
                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total a pagar</span>
                    S/ {{(Cart::subtotal() - $descuento_total) + ((Cart::subtotal() - $descuento_total) * (0.15))}}
                </p>
            </div>
        </div>
    </div>
</div>
