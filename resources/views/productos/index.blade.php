@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
    
    <a href="{{route('productos.productos.create')}}" class="btn btn-primary float-right">Crear producto</a>
    <h1>Listado de productos</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    @livewire('productos.productos-index')
@stop

@section('css')



@stop

@section('js')




@stop