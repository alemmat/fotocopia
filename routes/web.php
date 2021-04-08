<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\CaracteristicaController;
use App\Http\Controllers\CentroDeCopiadoController;
use App\Http\Controllers\PrecioController;
use App\Http\Controllers\ArchivoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/trabajos',TrabajoController::class)->only(['show']);
Route::resource('/archivos',ArchivoController::class)->only(['show']);
Route::resource('/caracteristicas',CaracteristicaController::class);
Route::resource('/centrodecopiado',CentroDeCopiadoController::class);
Route::resource('/precios',PrecioController::class);
