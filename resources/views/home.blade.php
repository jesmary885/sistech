@extends('adminlte::page')

@section('title', 'Tech Peru')

@section('content_header')
    
@stop

@section('content')

{{-- <div class="flex bg-indigo-500 ">
  <h1 class="text-xl text-sky-600 font-bold mt-6">
    <i class="fas fa-columns"></i> Tablero 
  </h1>
  <p class="text-sm text-gray-600 font-semibold mt-10 ml-2">
    Panel de control
  </p>

</div> --}}


<div class="row mt-4">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>

          <p>Ventas del dia</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Nueva venta <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>53</h3>

          <p>Productos Registrados</p>
        </div>
        <div class="icon">
          <i class="ion ion-filing"></i>
        </div>
        <a href="#" class="small-box-footer">Nuevo producto<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>44</h3>

          <p>Clientes registrados</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Nuevo cliente <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>Reportes</h3>

          <p>de ventas y productos</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Ver reportes<i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
