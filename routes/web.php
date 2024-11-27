<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalasDeJuegoController;
use App\Http\Controllers\ConsolasController;
use App\Http\Controllers\VideoJuegosController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('basic.auth')->group(function () {
    Route::prefix('salas')->group(function () {
        Route::get('listar', [SalasDeJuegoController::class, 'listar']);
        Route::post('crear', [SalasDeJuegoController::class, 'crear']);
    });

    Route::prefix('consolas')->group(function () {
        Route::get('listar', [ConsolasController::class, 'listar']);
        Route::post('crear', [ConsolasController::class, 'crear']);
    });

    Route::prefix('videojuegos')->group(function () {
        Route::get('listar', [VideoJuegosController::class, 'listar']);
        Route::post('crear', [VideoJuegosController::class, 'crear']);
    });
});
