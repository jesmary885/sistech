@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
    @livewire('admin.clientes.clientes-create',['vista' => 'clientes','accion' => 'create'])    
    <h1 class="text-lg ml-2"><i class="far fa-address-book"></i> Listado de Clientes</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    @livewire('admin.clientes.clientes-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop