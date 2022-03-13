<div>
    <section class="pt-4 pl-2 text-gray-700">

        <h5 class="modal-title font-bold text-sm text-gray-800 mb-3"> Equipos seleccionados para la venta</h5>

        
       
        @if (Cart::count())
        
        <table class="table table-sm table-striped table-responsive-md table-responsive-sm mt-3">
            <thead>
                    <tr>
                      
                        <th class="text-center text-sm">Producto</th>
                        <th class="text-center text-sm">Subtotal</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach (Cart::content() as $item)  
                        <tr>
                            
                            <td class="text-center text-sm">
                                <span> {{ $item->name }} S/N: {{ $item->options['serial'] }}</span>
                            </td>
                            <td class="text-center text-sm">
                                <span>S/ {{ $item->price }}</span>
                            </td>
                      

                            <td class="text-center">
                                <a class="text-center cursor-pointer hover:text-red-600"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')">
                                    <i class="fas fa-trash"></i>  
                                </a>
                            </td>
                     
                            
                        
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class=" mt-4">

            <div class="flex justify-between">
                <div>
                    <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" 
                    wire:click="destroy">
                    <i class="fas fa-trash"></i>
                    Borrar todo 
                    </a>

                </div>

                <div>
                    <p class="text-gray-700 font-bold">
                     
                        S/ {{Cart::subTotal()}}
                    </p>

                </div>
                

          

            </div>

            

       @else

       <hr class="m-0 p-0">

      
        
                <p class="text-sm justify-center text-gray-700 mt-4">No ha seleecionado ningún equipo</p>

               
        @endif

    </section>

    @if (Cart::count())
{{--         
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
                <div> --}}
                   
                {{-- </div>

                
            </div>
        </div> --}}

    @endif
</div>

