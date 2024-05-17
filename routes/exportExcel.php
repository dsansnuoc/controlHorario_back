<?php

use App\Http\Controllers\Export\Excel\ExportFichajeController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')->get('/roles', [RolesController::class, 'index']);
Route::get('/exportRol', [ExportFichajeController::class, 'exportRol']);

Route::post('/exportFichajes', [ExportFichajeController::class, 'exportFichajes']);
