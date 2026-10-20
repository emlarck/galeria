<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return redirect()->route('productos.index');
});

Route::resource('productos', ProductoController::class)->except(['create', 'edit', 'show']);
Route::resource('clientes', ClienteController::class)->except(['create', 'edit', 'show']);
Route::resource('ventas', VentaController::class)->except(['create', 'edit', 'show']);