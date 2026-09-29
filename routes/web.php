<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login.post');


Route::get('/productos', function () {
    return view('products.index');
})->name('products.index');


Route::get('/carrito', function () {
    return view('carrito.index');
})->name('carrito-index');


Route::get('/admin/compras', function () {
    return view('admin.compars');
})->name('admin-compras');

Route::get('/tienda', function () {
    return view('tienda.inicio');
})->name('inicio');