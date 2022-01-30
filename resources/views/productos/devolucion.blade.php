@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
<div class="flex  justify-between ">
    <h1 class="text-lg ml-2"> <i class="fas fa-clipboard-list"></i> Listado de devoluciones</h1>
    @livewire('productos.productos-devolucion-add')
</div>
@stop

@section('content')
    @livewire('productos.productos-devolucion')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
<script>
   /* Livewire.on('confirm', DevolucionProductoId => {
        Swal.fire({
            title: ¿Esta seguro que desea regresar el producto a inventario?,
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro'
        }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emitTo('productos.productos-devolucion', 'confirmacion', DevolucionProductoId)
            Swal.fire(
            'Acción realizada!',
            'success'
            )}
        })
    });*/
   
</script>
@stop