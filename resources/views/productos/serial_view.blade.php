@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')

<h1 class="text-lg ml-2"> <i class="fas fa-clipboard-list"></i> Listado de productos</h1>

@stop



@section('content')
    @livewire('productos.productos-serial-index',['sucursal' => $sucursal])
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop