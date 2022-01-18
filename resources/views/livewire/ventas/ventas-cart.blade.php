<div class="container py-4">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg text-gray-600 font-semibold mb-6">DETALLES DE LA VENTA</h1>

        @if (Cart::count())
        
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Precio</th>
                        <th></th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach (Cart::content() as $item)  
                        <tr>
                            <td class="text-center">
                                <span> {{ $item->name }}</span>
                            </td>
                            <td class="text-center">
                                <span> {{ $item->price }}</span>
                            </td>
                            <td class="text-center">
                                <a class="ml-12 cursor-pointer hover:text-red-600"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')">
                                    <i class="fas fa-trash"></i>  
                                </a>
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    @livewire('ventas.update-cart-item', ['rowId' => $item->rowId, 'sucursal' => $sucursal, 'producto' => $item->id], key($item->rowId))
                                </div>
                            </td>
                            <td class="text-center">
                             {{$item->price * $item->qty}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" 
                wire:click="destroy">
                <i class="fas fa-trash"></i>
                Borrar todos los productos
            </a>

        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRO DE COMPRAS ESTÁ VACÍO</p>

                <x-button-enlace href="/" class="mt-4 px-16">
                    Ir al inicio
                </x-button-enlace>
            </div>
        @endif

    </section>

    @if (Cart::count())
        
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div class="flex">

                    <div>
                        <a href="{{route('ventas.ventas.edit',$sucursal)}}" class="btn mr-2 btn-primary"><i class="fas fa-undo-alt"></i> Regresar</a>
                    </div>

                    <x-button-enlace href="{{route('facturacion',$sucursal)}}">
                        Continuar
                    </x-button-enlace>

                    
                </div>
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        S/ {{Cart::subTotal()}}
                    </p>
                </div>

                
            </div>
        </div>

    @endif
</div>

