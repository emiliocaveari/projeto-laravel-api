<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class PacienteController extends Controller
{
    
    public function index()
    {
        $pacientes = Paciente::all();
        return $pacientes->toArray();
    }


    public function medicos() : BelongsToMany
    {
        return $this->belongsToMany(Medico::class,'medico_paciente','paciente_id','medico_id');
    }


}
