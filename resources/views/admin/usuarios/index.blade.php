@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
    
    <a href="#" class="btn btn-secondary btn-sm float-right">Crear usuario</a>
    <h1>Listado de usuarios</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    @livewire('admin.usuarios-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop