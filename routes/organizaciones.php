<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizacionesController;

Route::middleware('auth:api')->get('/organizaciones', [OrganizacionesController::class, 'index']);

Route::middleware('auth:api')->post('/organizacionAlta', [OrganizacionesController::class, 'store']);

Route::middleware('auth:api')->post('/organizacionBuscar', [OrganizacionesController::class, 'show']);

Route::middleware('auth:api')->put('/organizacionActualizar/{id}', [OrganizacionesController::class, 'update']);

Route::middleware('auth:api')->post('/organizacionCambiarEstado', [OrganizacionesController::class, 'changeStatus']);
