@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
    
<a href="{{route('admin.usuarios.create')}}" class="btn btn-primary float-right"><i class="fas fa-user-plus"></i> Nuevo usuario</a>
    <h1 class="text-lg ml-2"><i class="far fa-address-book"></i> Listado de usuarios</h1>

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