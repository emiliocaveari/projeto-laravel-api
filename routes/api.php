<?php

use App\Http\Controllers\Api\CidadeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('auth/login', [AuthController::class,'login']);


Route::get('cidades', [CidadeController::class,'index']);

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('user', [AuthController::class,'user']);
});
