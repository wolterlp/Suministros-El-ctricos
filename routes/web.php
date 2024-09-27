<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('productos', ProductoController::class);
Route::resource('ventas', VentaController::class);
Route::resource('clientes', ClienteController::class);
Route::get('facturas/{venta}', [FacturaController::class, 'generarFactura'])->name('facturas.generar');
Route::resource('clientes', ClienteController::class);
Route::get('/factura/generar/{id}', [FacturaController::class, 'generarFactura'])->name('factura.generar');
Route::get('/facturas/{id}', [FacturaController::class, 'show'])->name('facturas.show');

Route::get('/inventario', [ProductoController::class, 'inventario'])->name('inventario.index');
Route::get('/inventario', [ProductoController::class, 'inventario'])->name('productos.inventario');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/inventario', [ProductoController::class, 'inventario'])->name('inventario.index'); // Asegúrate de esta línea
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
route::get('/productos/{id}/agregar-stock/{cantidad}', [ProductoController::class, 'agregarStock'])->name('productos.agregarStock');
