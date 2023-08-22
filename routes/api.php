<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1/auth'], function () {
    // /api/v1/auth/login
    Route::post('login', [AuthController::class, 'loginLaravel']);
    //Route::post('registro', [AuthController::class, 'registro']);    
    Route::post('registro', [AuthController::class, 'registro']);
    Route::group(["middleware" => "auth:sanctum"], function () {
        Route::get('perfil', [AuthController::class, 'perfil']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::get('/prueba', [AuthController::class, 'prueba']);
