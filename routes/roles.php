<?php

use App\Http\Controllers\Api\RolesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/roles', [RolesController::class, 'index']);
