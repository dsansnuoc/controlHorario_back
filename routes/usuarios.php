<?php

use App\Http\Controllers\Api\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/usuarios', [UsuariosController::class, 'index']);

Route::middleware('auth:api')->post('/usuarioAlta', [UsuariosController::class, 'store']);

Route::middleware('auth:api')->post('/usuarioBuscar', [UsuariosController::class, 'show']);

Route::middleware('auth:api')->put('/usuarioActualizar/{id}', [UsuariosController::class, 'update']);

Route::middleware('auth:api')->post('/usuarioCambiarEstado', [UsuariosController::class, 'changeStatus']);

Route::middleware('auth:api')->post('/usuariosOrganizaciones', [UsuariosController::class, 'indexUsersOrg']);