<?php

use App\Http\Controllers\Export\Csv\ExportFichajeControllerCsv;
use App\Http\Controllers\Export\Excel\ExportFichajeController;
use App\Http\Controllers\Export\Pdf\ExportFichajeControllerPdf;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Exporter\Exporter;

//Route::middleware('auth:api')->get('/roles', [RolesController::class, 'index']);
Route::middleware('auth:api')->get('/exportRol', [ExportFichajeController::class, 'exportRol']);

Route::middleware('auth:api')->post('/exportFichajes', [ExportFichajeController::class, 'exportFichajes']);

Route::middleware('auth:api')->post('/exportFichajesCsv', [ExportFichajeControllerCsv::class, 'exportFichajesCsv']);

Route::middleware('auth:api')->post('/exportFichajesPdf', [ExportFichajeControllerPdf::class, 'exportFichajesPdf']);