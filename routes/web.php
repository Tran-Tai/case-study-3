<?php

use App\Http\Controllers\BusesController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\TripsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [StationsController::class, 'index']);

Route::prefix('stations')->group(function () {
    Route::get('', [StationsController::class, 'index']);
    Route::get('/create', [StationsController::class, 'create']);
    Route::post('/create', [StationsController::class, 'store']);
    Route::get('/{id}', [StationsController::class, 'show']);
    Route::get('/{id}/edit', [StationsController::class, 'edit']);
    Route::put('/{id}', [StationsController::class, 'update']);
    Route::get('/{id}/delete', [StationsController::class, 'delete']);
    Route::delete('/{id}', [StationsController::class, 'destroy']);
});

Route::prefix('staffs')->group(function () {
    Route::get('', [StaffsController::class, 'index']);
    Route::get('/create', [StaffsController::class, 'create']);
    Route::post('/create', [StaffsController::class, 'store']);
    Route::get('/{id}', [StaffsController::class, 'show']);
    Route::get('/{id}/edit', [StaffsController::class, 'edit']);
    Route::put('/{id}', [StaffsController::class, 'update']);
    Route::get('/{id}/delete', [StaffsController::class, 'delete']);
    Route::delete('/{id}', [StaffsController::class, 'destroy']);
});

Route::prefix('routes')->group(function () {
    Route::get('', [RoutesController::class, 'index']);
    Route::get('/create', [RoutesController::class, 'create']);
    Route::post('/create', [RoutesController::class, 'store']);
    Route::get('/{id}', [RoutesController::class, 'show']);
    Route::get('/{id}/edit', [RoutesController::class, 'edit']);
    Route::put('/{id}', [RoutesController::class, 'update']);
    Route::get('/{id}/delete', [RoutesController::class, 'delete']);
    Route::delete('/{id}', [RoutesController::class, 'destroy']);
});

Route::prefix('buses')->group(function () {
    Route::get('', [BusesController::class, 'index']);
    Route::get('/create', [BusesController::class, 'create']);
    Route::post('/create', [BusesController::class, 'store']);
    Route::get('/{id}', [BusesController::class, 'show']);
    Route::get('/{id}/edit', [BusesController::class, 'edit']);
    Route::put('/{id}', [BusesController::class, 'update']);
    Route::get('/{id}/delete', [BusesController::class, 'delete']);
    Route::delete('/{id}', [BusesController::class, 'destroy']);
});

Route::prefix('trips')->group(function () {
    Route::get('/route/{route_id}', [TripsController::class, 'index']);
    Route::get('/create/{route_id}', [TripsController::class, 'create']);
    Route::post('/create/{route_id}', [TripsController::class, 'store']);
    Route::post('/getInfo', [TripsController::class, 'info']);
    Route::get('/{id}', [TripsController::class, 'show']);
    Route::get('/{id}/edit', [TripsController::class, 'edit']);
    Route::put('/{id}', [TripsController::class, 'update']);
    Route::get('/{id}/delete', [TripsController::class, 'delete']);
    Route::delete('/{id}', [TripsController::class, 'destroy']);
});
