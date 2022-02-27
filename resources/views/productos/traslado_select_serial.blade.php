@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
@stop

@section('content')
    @livewire('productos.productos-detalle-traslado',['sucursal' => $sucursal,'producto' => $producto])
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop