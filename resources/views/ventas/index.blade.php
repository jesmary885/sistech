@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
    <h1 class="text-lg ml-2"><i class="far fa-address-book"></i> Listado de ventas</h1>
@stop

@section('content')
    @if ($tipo == 'contado')
        @livewire('ventas.ventas-contado')
    @else
        @livewire('ventas.ventas-credito')
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop