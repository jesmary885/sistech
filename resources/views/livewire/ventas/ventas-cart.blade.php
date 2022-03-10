<div class="py-4">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h1 class="text-lg text-gray-600 font-semibold mb-6">DETALLES DE LA VENTA</h1>
            </div>
         
                <div class="ml-2">
                    <button
                        title="Ayuda a usuario"
                        class="btn btn-success btn-sm mb-6" 
                        wire:click="ayuda"><i class="fas fa-info"></i>
                        Guía rápida
                    </button>
                </div>

       
        </div>

        <hr class="p-0 mb-2 mt-0">
        

        @if (Cart::count())
        
            <table class="table-striped w-full">
                <thead>
                    <tr>
                        <th class="text-center">Producto</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Serial</th>
                        <th class="text-center"></th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach (Cart::content() as $item)  
                        <tr>
                            <td class="text-center">
                                <span> {{ $item->name }}</span>
                            </td>
                            <td class="text-center">
                                <span>S/ {{ $item->price }}</span>
                            </td>
                            <td class="text-center">
                                <span> {{ $item->options['serial'] }}</span>
                            </td>
                     
                            <td class="text-center">
                                <a class="ml-12 text-center cursor-pointer hover:text-red-600"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')">
                                    <i class="fas fa-trash"></i>  
                                </a>
                            </td>
                        
                            <td class="text-center">
                             S/ {{$item->price * $item->qty}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="p-0 m-0">

            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" 
                wire:click="destroy">
                <i class="fas fa-trash"></i>
                Borrar todos los productos
            </a>

        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRO DE COMPRAS ESTÁ VACÍO</p>

                <div>
                    <a href="{{route('ventas.ventas.edit',$sucursal)}}" class="btn mr-2 btn-primary"> << Regresar</a>
                </div>
            </div>
        @endif

    </section>

    @if (Cart::count())
        
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div class="flex">

                    <div>
                        <a href="{{route('ventas.ventas.edit',$sucursal)}}" class="btn mr-2 btn-primary"> << Regresar</a>
                    </div>

                    <x-button-enlace href="{{route('facturacion',$sucursal)}}">
                        Continuar >>
                    </x-button-enlace>

                    
                </div>
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">TOTAL </span>
                        S/ {{Cart::subTotal()}}
                    </p>
                </div>

                
            </div>
        </div>

    @endif
</div>

