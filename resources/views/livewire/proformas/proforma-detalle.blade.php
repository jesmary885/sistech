<div>
    <button type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="fas fa-file-invoice"></i>
   </button> 

   @if($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;" wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title text-lg">Detalle de la proforma</h1>   
                    </div>
                    <div class="modal-body">
                        <div class="flex justify-between">
                            <p class="text-lg text-gray-600"><b>Fecha:</b> {{$fecha_creacion}}</p>
                            <h2 class="text-lg text-gray-600"><b>Factura Proforma Nro. {{$factura_nro}}</b></h2>
                        </div>
                        <hr class="mt-2 mb-2">
                        <h3 class="text-lg text-gray-600">Datos del cliente</h3>
                        <div class="flex justify-between">
                            <p>Nombre: {{$nombre_cliente}} {{$apellido_cliente}}</p>
                            <p>Documento: {{$tipo_doc_cliente}} - {{$doc_cliente}}</p>
                        </div>
                        <hr class="mt-2 mb-2">
                        <h3 class="text-lg text-gray-600">Datos de atención</h3>
                        <div class="flex justify-between">
                            <p>Nombre del cajero: {{$nombre_usuario}} {{$apellido_usuario}}</p>
                            <p>Sucursal: {{$sucursal}}</p>
                        </div>
                        <hr class="mt-2 mb-2">
                        <h3 class="text-lg ml-4 text-gray-600"><b>Datos de la venta</b></h3>
                        <div class="card">
                            @if ($productos->count())
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Cant</th>
                                                <th>Producto</th>
                                                <th>Serial</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{$producto->productoSerialSucursal->producto->nombre}}</td>
                                                    <td>{{$producto->productoSerialSucursal->serial}}</td>
                                                    <td>{{$producto->precio}}</td>
                                                    <td>{{$producto->precio}}</td>
                                                </tr>
                                            @endforeach                     
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Subtotal</td>
                                                <td>{{$subtotal}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Descuento</td>
                                                <td>{{$descuento}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Impuesto</td>
                                                <td>{{$impuesto}}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total a pagar</td>
                                                <td>{{$total}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                 <div class="card-body">
                                    <strong>No hay registros</strong>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close" >Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="export_pdf()"><i class="far fa-file-pdf"></i> Exportar Factura proforma</button>
      
                    </div>
                </div>
            </div>
        </div>
   @endif
</div>