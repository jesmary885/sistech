<?php

use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\MarcasController;
use App\Http\Controllers\Admin\ModelosController;
use App\Http\Controllers\Admin\ProveedoresController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SucursalesController;
use App\Http\Controllers\Productos\MovimientosController;
use App\Http\Controllers\Productos\ProductosController;
use App\Http\Controllers\Productos\ProductosMovController;
use App\Http\Controllers\Ventas\FacturacionController;
use App\Http\Controllers\Ventas\MostrarVentasController;
use App\Http\Controllers\Ventas\VentasController;
use App\Http\Livewire\Productos\ProductosTraslado;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth/login');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Auth::routes();

//Gestion administrativa





Route::resource('roles', RoleController::class)->only('index','edit','update','destroy','create','store')->names('admin.roles');
Route::resource('clientes', ClientesController::class)->only('index','edit','update')->names('admin.clientes');
Route::resource('proveedores', ProveedoresController::class)->only('index','edit','update')->names('admin.proveedores');
Route::resource('sucursales', SucursalesController::class)->only('index','edit','update')->names('admin.sucursales');
Route::resource('categorias', CategoriasController::class)->only('index','edit','update')->names('admin.categorias');
Route::resource('marcas', MarcasController::class)->only('index','edit','update')->names('admin.marcas');
Route::resource('modelos', ModelosController::class)->only('index','edit','update')->names('admin.modelos');
Route::resource('productos', ProductosController::class)->only('index','create','edit')->names('productos.productos');
// Route::resource('productos_mov', ProductosMovController::class)->only('index','show','historial','create')->names('productos.movimiento');
Route::resource('Ventas', VentasController::class)->only('create','index','edit','update','show')->names('ventas.ventas');
Route::resource('Mostrar_ventas', MostrarVentasController::class)->only('create','index','edit','update','show')->names('ventas.mostrar_ventas');

Route::get('facturacion/{sucursal}',[FacturacionController::class,'facturacion'])->name('facturacion');

Route::get('traslado',[MovimientosController::class,'index'])->name('traslado.index');
Route::get('historial',[MovimientosController::class,'historial'])->name('movimientos.historial');
Route::get('devolucion',[MovimientosController::class,'devolucion'])->name('devolucion.index');
Route::get('devolucion_registro',[MovimientosController::class,'devolucion_create'])->name('devolucion.create');
Route::get('traslado/{sucursal}',[MovimientosController::class,'select'])->name('productos.traslado.select');
Route::get('historial/{producto}/{fecha_inicio}/{fecha_fin}',[MovimientosController::class,'historial_detalle'])->name('movimientos.historial.detalle');

// livewire

Route::get('productos/{sucursal}/traslado', ProductosTraslado::class)->name('producto.traslado.view');




