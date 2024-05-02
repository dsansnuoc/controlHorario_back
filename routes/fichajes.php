<?php

use App\Http\Controllers\Api\FichajeController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->post('/ultimoFichaje', [FichajeController::class, 'show']);

Route::middleware('auth:api')->post('/altaFichaje', [FichajeController::class, 'altaFichaje']);
