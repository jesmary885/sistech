@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <x-validation-errors class="mb-4" />
                <h2 class="text-lg text-gray-600">Indique la modalidad de reporte</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('movimientos.buscar') }}">
                    @csrf
                    <div class="flex items-center">
                        <div>
                            <select id="modalidad" class="w-52 form-control h-8 text-m" name="modalidad">
                                <option value="" selected>Seleccione una opción</option>
                                <option value="1">Productos por código de barra</option>
                                <option value="2">Productos por serial</option>
                            </select>
                        </div>
                        <div class="ml-2 flex-1 items-center">
                            <x-button>
                                {{ __('Buscar') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop