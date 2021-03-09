<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTrabajoController;
use App\Http\Controllers\ApiCentroDeCopiado;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('trabajos', ApiTrabajoController::class)->only([
    'store'
]);

Route::apiResource('centrodecopiado', ApiCentroDeCopiado::class)->only([
    'index'
]);
