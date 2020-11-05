<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/distancia', [PedidoController::class, 'calcularLatLong'])->name('distancia.calcular');