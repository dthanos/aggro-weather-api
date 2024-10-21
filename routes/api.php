<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RemoteApiController;
use App\Http\Controllers\LocationController;

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


Route::prefix('remote_api')->group(function() {
    Route::get('/', [RemoteApiController::class, 'index']);
    Route::get('{remote_api}', [RemoteApiController::class, 'show']);
    Route::put('{remote_api}', [RemoteApiController::class, 'update']);
    Route::post('/', [RemoteApiController::class, 'store']);
    Route::delete('{remote_api}', [RemoteApiController::class, 'delete']);
});
Route::prefix('location')->group(function() {
    Route::get('/', [LocationController::class, 'index']);
    Route::get('{location}', [LocationController::class, 'show']);
    Route::put('{location}', [LocationController::class, 'update']);
    Route::post('/', [LocationController::class, 'store']);
    Route::delete('{location}', [LocationController::class, 'delete']);
});
Route::prefix('forecast')->group(function() {
    Route::get('/', [ForecastController::class, 'index']);
    Route::put('/run', [ForecastController::class, 'run']);
});
