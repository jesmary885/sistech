<?php

use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\ComprasController;
use App\Http\Controllers\Admin\MarcasController;
use App\Http\Controllers\Admin\ModelosController;
use App\Http\Controllers\Admin\ProveedoresController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SucursalesController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Movimientos\MovimientoController;
use App\Http\Controllers\Productos\FilesController;
use App\Http\Controllers\Productos\MovimientosController;
use App\Http\Controllers\Productos\ProductosController;
use App\Http\Controllers\Productos\ProductosMovController;
use App\Http\Controllers\Productos\ProductosSerialController;
use App\Http\Controllers\Proformas\ProformasController;
use App\Http\Controllers\Reportes\ReportesController;
use App\Http\Controllers\Ventas\FacturacionController;
use App\Http\Controllers\Ventas\MostrarVentasController;
use App\Http\Controllers\Ventas\VentasController;
use App\Http\Controllers\Ventas\VentasViewController;
use App\Http\Livewire\Productos\ProductosTraslado;
use App\Http\Livewire\Ventas\VentasPorCliente;
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

Route::get('/home',[HomeController::class,'index'])->name('home');


Auth::routes();

//Gestion administrativa
Route::middleware(['auth'])->group(function()
{

Route::resource('roles', RoleController::class)->only('index','edit','update','destroy','create','store')->names('admin.roles');
Route::resource('clientes', ClientesController::class)->only('index')->names('admin.clientes');
Route::resource('proveedores', ProveedoresController::class)->only('index')->names('admin.proveedores');
Route::resource('sucursales', SucursalesController::class)->only('index')->names('admin.sucursales');
Route::resource('categorias', CategoriasController::class)->only('index')->names('admin.categorias');
Route::resource('marcas', MarcasController::class)->only('index')->names('admin.marcas');
Route::resource('modelos', ModelosController::class)->only('index')->names('admin.modelos');
Route::resource('productos', ProductosController::class)->only('index','create','edit')->names('productos.productos');
Route::resource('Ventas', VentasController::class)->only('create','index','edit','update','show')->names('ventas.ventas');
Route::resource('Mostrar_ventas', MostrarVentasController::class)->only('create','index','edit','update','show')->names('ventas.mostrar_ventas');
Route::get('compras',[ComprasController::class,'index'])->name('admin.compras.index');

Route::get('facturacion/{sucursal}/{proforma}',[FacturacionController::class,'facturacion'])->name('facturacion');

Route::get('traslado',[MovimientosController::class,'index'])->name('traslado.index');
Route::get('traslado/{sucursal}',[MovimientosController::class,'select'])->name('productos.traslado.select');
Route::get('traslado/{sucursal}/{producto}',[MovimientosController::class,'select_serial'])->name('productos.traslado.serial');


Route::get('devolucion',[MovimientosController::class,'devolucion'])->name('devolucion.index');
Route::get('devolucion_registro',[MovimientosController::class,'devolucion_create'])->name('devolucion.create');

//Proformas

Route::get('Proforma',[ProformasController::class,'index'])->name('proformas.proformas.index');
Route::get('Proforma_lista',[ProformasController::class,'view'])->name('proformas.view');
Route::get('Ventas/{sucursal}/{proforma}',[ProformasController::class,'seleccio'])->name('ventas.seleccio');

//Movimientos en caja

Route::get('Movimientos_caja',[MovimientoController::class,'index'])->name('movimiento.caja.index');
Route::get('Nuevo_movimiento_caja/{sucursal}',[MovimientoController::class,'view'])->name('movimiento.caja.view');



//Reportes

//reportes de historial de productos
Route::get('historial_modalidad',[MovimientosController::class,'select_modalidad'])->name('movimientos.modalidad');
Route::post('historial_modalidad',[MovimientosController::class,'buscar'])->name('movimientos.buscar');
Route::get('historial_modalidad/productos_cod_barra',[MovimientosController::class,'historial'])->name('movimientos.historial');
Route::get('historial_modalidad/productos_serial',[MovimientosController::class,'historial_prod_serial'])->name('movimientos.historial_prod_serial');
Route::get('historial_modalidad/{vista}/{producto}/{fecha_inicio}/{fecha_fin}',[MovimientosController::class,'historial_detalle'])->name('movimientos.historial.detalle');

//reporte de productos mas vendidos
Route::get('reporte_poducto',[ReportesController::class,'index_producto'])->name('reportes.index.productos');
Route::get('reportes_productos/{sucursal_id}/{fecha_inicio}/{fecha_fin}',[ReportesController::class,'productos'])->name('productos.reportes');
//reporte de ventas
Route::get('reporte_venta',[ReportesController::class,'index_venta'])->name('reportes.index.ventas');
Route::get('reportes_ventas/{sucursal_id}/{fecha_inicio}/{fecha_fin}',[ReportesController::class,'ventas'])->name('ventas.reportes');
Route::get('ventas_clientes',[VentasViewController::class,'index'])->name('ventas.clientes');
//reporte de traslados
Route::get('reporte_traslados',[ReportesController::class,'index_traslados'])->name('reportes.index.traslados'); 
Route::get('reportes_traslados/{fecha_inicio}/{fecha_fin}',[ReportesController::class,'traslados'])->name('traslados.reportes');

// livewire

//Route::get('productos/{sucursal}/traslado', ProductosTraslado::class)->name('reportes.index.traslados');

//Cargar imagen de producto
Route::post('productos/{product}/files', [FilesController::class, 'files'])->name('productos.files');

//productos por serial

Route::get('productos_serial',[ProductosSerialController::class,'index'])->name('productos.serial.index');
Route::get('productos_serial/{sucursal}',[ProductosSerialController::class,'view'])->name('productos.serial.view');

//Ajustes

Route::get('cambiar_contrasena',[AjustesController::class,'ccontrasena'])->name('ajustes.ccontrasena');
Route::get('sobre_empresa',[AjustesController::class,'empresa'])->name('ajustes.empresa');

});

