<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Resources\PacienteResource;
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


    public function store(StorePacienteRequest $request)
    {
        $data = $request->validated();

        $Paciente = new Paciente();
        if ( !$paciente = $Paciente->create($data) )
            return response()->json(['message'=>'Unable to create new record'],500);

        return new PacienteResource($paciente);
    }


}
