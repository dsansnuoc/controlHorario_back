<?php

use App\Http\Controllers\Api\TipoParadaController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->post('/tipoPausa', [TipoParadaController::class, 'index']);

Route::middleware('auth:api')->post('/tipoPausaAlta', [TipoParadaController::class, 'store']);

Route::middleware('auth:api')->put('/tipoPausaActualizar/{id}', [TipoParadaController::class, 'update']);

Route::middleware('auth:api')->post('/tipoPausaBuscar', [TipoParadaController::class, 'show']);
