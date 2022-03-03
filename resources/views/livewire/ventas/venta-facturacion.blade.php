<div x-data="{ tipo_pago: @entangle('tipo_pago'),siguiente_venta: @entangle('siguiente_venta'), imprimir: @entangle('imprimir'),send_email: @entangle('send_email'),tipo_comprobante: @entangle('tipo_comprobante'),carrito: @entangle('carrito')}" class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        <div class="bg-white rounded-lg shadow mb-2 pb-2" :class="{'hidden': carrito == ''}">
            <div>
                <input wire:model="search" placeholder="*Seleccione el cliente o escriba aquí su nombre, apellido o nro documento a buscar" class="form-control">
            </div>
            @if ($clientes->count())
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Documento</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Puntos</th>
                                <th>@livewire('admin.clientes.clientes-create',['vista' => "ventas",'accion' => 'create'])</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td class="text-center">{{$cliente->nombre}} {{$cliente->apellido}}</td>
                                    <td class="text-center">{{$cliente->nro_documento}}</td>
                                    <td class="text-center">{{$cliente->email}}</td>
                                    <td class="text-center">{{$cliente->puntos}}</td>
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

            
        <div  class="bg-white rounded-lg shadow w-full py-2" :class="{'hidden': carrito == ''}">

            <div class="flex justify-between w-full h-full mt-2">
                <div class="ml-2 mr-2 w-full">
                    <select id="metodo_pago" wire:model="metodo_pago" title="Método de pago" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                        <option value="" selected>*Método de pago</option>
                        <option value="1">Efectivo</option>
                        <option value="2">Tarjeta Credito</option>
                        <option value="3">Tarjeta Debito </option>
                    </select>
                    <x-input-error for="metodo_pago" />
                </div>
                <div class="mr-2 w-full">
                    <select id="tipo_pago" wire:model="tipo_pago" title="Tipo de pago" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_pago">
                        <option value="" selected>*Tipo de pago</option>
                        <option value="1">Contado</option>
                        <option value="2">Crédito</option>
                    </select>
                    <x-input-error for="tipo_pago" />
                </div>
                {{--  --}}
            </div>

            <div class="flex justify-between w-full h-full mt-2">
                <div class="ml-2 mr-2 w-full">
                    <select id="estado_entrega" wire:model="estado_entrega" title="Estado de la entrega" class="block w-full bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_garantia">
                        <option value="" selected>*Estado de entrega</option>
                        <option value="1">Entregado</option>
                        <option value="2">Por entregar</option>
                    </select>
                    <x-input-error for="estado_entrega" />
                </div>
                <div class="mr-2 w-full">
                    <div class="w-full mr-2">
                        <input wire:model="descuento" type="number" title="Descuento en venta" class="w-full px-2 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="*Descuento en venta %">
                        <x-input-error for="descuento" />
                    </div>
                </div>
            </div>


            <div :class="{'hidden': tipo_pago != 2}">
                    <div class="w-1/4 m-2">
                        <input wire:model="pago_cliente" type="number" class="w-full px-4 appearance-none block bg-gray-100 text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="*Total pagado">
                        <x-input-error for="pago_cliente" />
                    </div>
            </div>

            <hr>
            
            <div class="flex w-full h-full mt-1 ml-4">
                <input type="checkbox" class="ml-1 mt-1" wire:model="send_mail" value="1">
                <p class="text-sm font-semibold text-gray-500 ml-2">Enviar comprobante al correo del cliente</p>
            </div>

            <div class="flex w-full h-full mt-1 ml-4">
                <input type="checkbox" class=" ml-1 mt-1" wire:model="imprimir" value="1">
                <p class="text-sm font-semibold text-gray-500 ml-2">Imprimir comprobante</p>
            </div>

            <div class="flex justify-start mt-2">
                <div class="ml-2 mr-2" :class="{'hidden': (imprimir != 1)}">
                        <select id="tipo_comprobante" wire:model="tipo_comprobante" title="Tipo de comprobante" class="block bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tipo_comprobante">
                            <option value="" selected>*Comprobante</option>
                            <option value="1">Factura</option>
                            <option value="2">Ticket</option>
                        </select>
                        <x-input-error for="tipo_comprobante" />
                </div>
                {{-- <div :class="{'hidden': tipo_comprobante != 2 }">
                    <div :class="{'hidden': (imprimir != 1)}">
                        <select wire:model="impresora_id" class="block bg-gray-100 border border-gray-200 text-gray-400 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" selected>Seleccione la impresora</option>
                            @foreach ($impresoras as $impresora)
                                <option value="{{$impresora->id}}">{{$impresora->nombre}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="impresora_id" />
                    </div>
                </div> --}}
            </div>

            <h2 class="text-sm mt-4 ml-4 text-red-600 font-semibold"> * Campos obligatorios</h2>
        </div>

       

        <div class="flex" :class="{'hidden': carrito == ''}">
            <div class="mr-2">
                <a href="{{route('ventas.ventas.show',$sucursal)}}" class="btn mt-6 mb-4 btn-primary"><< Regresar</a>
            </div>
            
            <x-button
                wire:loading.attr="disabled"
                wire:target="save"
                class="mt-6 mb-4 mr-2" 
                wire:click="save">
                <i class="fas fa-file-invoice mr-1"></i>
                Guardar venta
            </x-button>
        </div>
    
        <div :class="{'hidden': carrito != ''}">
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

    <div class="col-span-2" :class="{'hidden': carrito == ''}">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="border-b border-gray-200">
                        <article>
                            <h1 class="font-bold mr-4 text-lg text-gray-600">{{$item->name}}</h1>
                            <div class="flex">
                                <p class="mr-2 text-sm font-semibold">S/N: {{$item->options['serial']}}</p>
                                <p class="text-sm"> - Precio: S/ {{$item->price}} - </p> 
                                <p class="text-sm font-semibold text-red-600 ml-2"> Puntos: {{$item->options['puntos']}}</p> 
                                @if ($puntos_canjeo >  $item->options['puntos'])
                                    <x-button
                                    wire:loading.attr="disabled"
                                    wire:target="canjear"
                                    class=" btn-sm mb-2 ml-2" 
                                    wire:click="canjear('{{$item->id}}}')">
                                    <i class="fas fa-file-invoice"></i>
                                    </x-button>  
                                @endif
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
                    <x-input-error for="cliente_select" />
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
                    @if ($canjeo == false)
                        <span class="font-semibold">S/ {{Cart::subtotal() * ((int)($this->descuento) / 100)}}</span>
                    @else
                        <span class="font-semibold">S/ {{$descuento_total}}</span>
                    @endif
                   
                    
                    {{-- <span class="font-semibold">S/ {{$descuento_total = Cart::subtotal() * ($this->descuento / 100)}}</span> --}}
                </p>
                <p class="flex justify-between items-center">
                    Subtotal menos descuento
                    <span class="font-semibold">S/ {{Cart::subtotal() - $descuento_total}}</span>
                </p>
                <p class="flex justify-between items-center">
                    IVA {{$iva*100}} %
                    <span class="font-semibold">
                    S/ {{Cart::subtotal() * $this->iva}}
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
                        S/ {{((Cart::subtotal() - $descuento_total) + ((Cart::subtotal() - $descuento_total) * ($iva))) - ((int)$pago_cliente)}}
                        </span>
                    </p>
                </div>
                
                <hr class="mt-4 mb-3">
                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total a pagar</span>
                    S/ {{( (Cart::subtotal() * $this->iva) + Cart::subtotal() ) - ($descuento_total)}}
                </p>
            </div>
        </div>
    </div>
</div>
