<?php

use App\Http\Controllers\Juegos\ConsolasController;
use App\Http\Controllers\Juegos\SalasDeJuegoController;
use App\Http\Controllers\Juegos\VideoJuegosController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\Usuarios\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::middleware('basic.auth')->group(function () {
    Route::prefix('usuarios')->group(function () {
        Route::get('listar', [UsuariosController::class, 'listar']);
        Route::post('crear/{id?}', [UsuariosController::class, 'crear']);
        Route::delete('eliminar/{id}', [UsuariosController::class, 'eliminar']);
    });

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

    Route::prefix('autenticacion')->group(function () {
        Route::post('registrar', [AutenticacionController::class, 'registrarCliente']);
        Route::post('login', [AutenticacionController::class, 'login']);
        Route::post('verificar', [AutenticacionController::class, 'verificarTokenRol']);
    });
});
