<?php

use Illuminate\Support\Facades\Route;
use App\Models\Medicamento;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DevolucionController;


// Rutas para Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/menuadmin', function () {
    return view('menu.menuadmin');
})->middleware('auth')->name('menuadmin');

Route::get('/menubasico', function () {
    return view('menu.menubasico');
})->middleware('auth')->name('menubasico');


// Rutas para UsuarioController
Route::resource('/usuario', 'App\Http\Controllers\UsuarioController');
Route::get('/usuarioelim/{id}', [UsuarioController::class, 'confirmDelete'])->name('usuario.confirmDelete');


// Rutas para MedicamentoController
Route::get('/medicamento/reset', [MedicamentoController::class, 'reset'])->name('medicamento.reset');
Route::get('/medicamento/search', [MedicamentoController::class, 'search'])->name('medicamento.search');
Route::resource('/medicamento', MedicamentoController::class);
Route::get('/medicamento', [MedicamentoController::class, 'index'])->name('medicamento.index');
Route::get('/medicamentocreate/{id}', [MedicamentoController::class, 'create']);
Route::get('/medicamentoedit/{id}', [MedicamentoController::class, 'edit']);
Route::get('/medicamento/eliminar/{id}', [MedicamentoController::class, 'confirmDelete'])->name('medicamento.delete');
Route::get('/inventario/buscar', [MedicamentoController::class, 'search'])->name('inventario.searchInventario');


// Rutas para EntradaController
Route::get('/entrada', [EntradaController::class, 'index'])->name('entrada.index');
Route::get('/entrada/create', [EntradaController::class, 'create'])->name('entrada.create');
Route::post('/entrada', [EntradaController::class, 'store'])->name('entrada.store');
Route::get('/entrada/{id}', [EntradaController::class, 'show'])->name('entrada.show');
Route::get('/entrada/{id}/edit', [EntradaController::class, 'edit'])->name('entrada.edit');
Route::put('/entrada/{id}', [EntradaController::class, 'update'])->name('entrada.update');
Route::get('/entrada/confirmar-eliminar/{id}', [EntradaController::class, 'confirmDelete'])->name('entrada.confirmDelete');
Route::delete('/entrada/{id}', [EntradaController::class, 'destroy'])->name('entrada.destroy');

// Rutas para SalidaController
Route::get('/salida', [SalidaController::class, 'index'])->name('salida.index');
Route::get('/salida/create', [SalidaController::class, 'create'])->name('salida.create');
Route::post('/salida', [SalidaController::class, 'store'])->name('salida.store');
Route::get('/salida/{id}', [SalidaController::class, 'show'])->name('salida.show');
Route::get('/salida/{id}/edit', [SalidaController::class, 'edit'])->name('salida.edit');
Route::put('/salida/{id}', [SalidaController::class, 'update'])->name('salida.update');
Route::get('/salida/confirmar-eliminar/{id}', [SalidaController::class, 'confirmDelete'])->name('salida.confirmDelete');
Route::delete('/salida/{id}', [SalidaController::class, 'destroy'])->name('salida.destroy');


// Rutas para VentaController
Route::get('/venta', [VentaController::class, 'index'])->name('venta.index');
Route::get('venta/create', [VentaController::class, 'create'])->name('venta.create');
Route::post('/venta', [VentaController::class, 'store'])->name('venta.store');
Route::get('/venta/{id}', [VentaController::class, 'show'])->name('venta.show');
Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('venta.edit');
Route::put('/venta/{venta}', [VentaController::class, 'update'])->name('venta.update');
Route::get('/venta/{id}/delete', [VentaController::class, 'confirmDelete'])->name('venta.confirmDelete');
Route::delete('/venta/{venta}', [VentaController::class, 'destroy'])->name('venta.destroy');


// Rutas para DetalleVentaController
Route::get('/detalleventa', [DetalleVentaController::class, 'index'])->name('detalleventa.index');


// Rutas para DevolucionController
Route::get('/devolucion', [DevolucionController::class, 'index'])->name('devolucion.index');
Route::get('/devolucion/create', [DevolucionController::class, 'create'])->name('devolucion.create');
Route::post('/devolucion', [DevolucionController::class, 'store'])->name('devolucion.store');
Route::get('/devolucion/{id}', [DevolucionController::class, 'show'])->name('devolucion.show');
Route::get('/devolucion/{id}/edit', [DevolucionController::class, 'edit'])->name('devolucion.edit');
Route::put('/devolucion/{id}', [DevolucionController::class, 'update'])->name('devolucion.update');
Route::get('/devolucion/confirmar-eliminar/{id}', [DevolucionController::class, 'confirmDelete'])->name('devolucion.confirmDelete');
Route::delete('/devolucion/{id}/delete', [DevolucionController::class, 'destroy'])->name('devolucion.delete');


// Ruta para Inventario
Route::get('/inventario', function () {
    $medicamentos = Medicamento::all();
    return view('inventario.index', compact('medicamentos'));
});