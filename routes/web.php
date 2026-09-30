<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\CompraWebController;
use App\Http\Controllers\ProductoWebController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\TiendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Públicas
Route::get('/login', [SesionController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [SesionController::class, 'login'])->name('login.post');
Route::get('/registro', [SesionController::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [SesionController::class, 'registro'])->name('registro.post');

// Protegidas (requieren sesión iniciada)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [SesionController::class, 'logout'])->name('logout');

    Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda');
    Route::post('/carrito/agregar/{producto}', [TiendaController::class, 'agregarAlCarrito'])->name('carrito.agregar');
    Route::get('/carrito', [TiendaController::class, 'verCarrito'])->name('carrito');
    Route::delete('/carrito/{producto}', [TiendaController::class, 'quitarDelCarrito'])->name('carrito.quitar');

    Route::post('/compras', [CompraWebController::class, 'store'])->name('compras.store');
    Route::get('/compras', [CompraWebController::class, 'index'])->name('compras.index');
    Route::get('/compras/{id}/factura', [CompraWebController::class, 'factura'])->name('compras.factura');

    Route::get('/admin/historial', [AdminWebController::class, 'historial'])->name('admin.historial');

    Route::get('/admin/productos', [ProductoWebController::class, 'index'])->name('admin.productos');
    Route::get('/admin/productos/crear', [ProductoWebController::class, 'create'])->name('admin.productos.crear');
    Route::post('/admin/productos', [ProductoWebController::class, 'store'])->name('admin.productos.store');
});
