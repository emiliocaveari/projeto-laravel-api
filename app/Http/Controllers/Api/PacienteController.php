<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    

    public function index()
    {
        $pacientes = Paciente::all();
        return $pacientes->toArray();
    }


}
