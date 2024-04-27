<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EntradaController;

/*
Route::apiResource('/entrada', EntradaController::class);
*/

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/entrada', EntradaController::class);
});

Route::post('/entradaLogin', [EntradaController::class, 'entrada']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


require __DIR__ . '/auth.php';

include 'organizaciones.php';
include 'usuarios.php';
include 'roles..php';
