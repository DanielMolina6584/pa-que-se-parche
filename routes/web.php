<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalasDeJuegoController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('salas')->group(function () {
    Route::get('listar', [SalasDeJuegoController::class, 'listarSalasDeJuego']);
});
