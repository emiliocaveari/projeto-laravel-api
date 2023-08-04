<?php

use App\Http\Controllers\Api\CidadeController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('login', [AuthController::class,'login']);


Route::get('cidades', [CidadeController::class,'index']);

Route::get('pacientes', [PacienteController::class,'index']);
Route::post('pacientes', [PacienteController::class,'store']);
Route::put('pacientes/{paciente_id}', [PacienteController::class,'update']);


Route::get('medicos', [MedicoController::class,'index']);
Route::get('medicos/{medico_id}/pacientes', [MedicoController::class,'pacientes']);
Route::get('cidades/{cidade_id}/medicos', [MedicoController::class,'bycidade']);
Route::post('medicos', [MedicoController::class,'store']);
Route::post('medicos/{id_medico}/pacientes', [MedicoController::class,'pacientesync']);

Route::group([
    'middleware' => 'auth:api'
], function ($router) {

    
    Route::get('user', [AuthController::class,'user']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
});
