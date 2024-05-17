<?php

use App\Http\Controllers\Api\SolicitudesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->post('/solicitudes', [SolicitudesController::class, 'show']);

Route::middleware('auth:api')->put('/solicitudActualizar/{id}', [SolicitudesController::class, 'update']);
