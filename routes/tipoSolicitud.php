<?php

use App\Http\Controllers\Api\TipoSolicitudController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->post('/tipoSolicitud', [TipoSolicitudController::class, 'index']);

Route::middleware('auth:api')->post('/tipoSolicitudAlta', [TipoSolicitudController::class, 'store']);

Route::middleware('auth:api')->put('/tipoSolicitudActualizar/{id}', [TipoSolicitudController::class, 'update']);

Route::middleware('auth:api')->post('/tipoSolicitudBuscar', [TipoSolicitudController::class, 'show']);
