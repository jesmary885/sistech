@extends('adminlte::page')

@section('title', 'TechPeru')

@section('content_header')
    
@stop

@section('content')
 @livewire('reportes.reporte-caja',['sucursal_id' => $sucursal_id, 'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin]) 
@stop

@section('css')

@stop

@section('js')

@stop