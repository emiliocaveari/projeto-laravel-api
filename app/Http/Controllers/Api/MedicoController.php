<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicoResource;
use App\Models\Medico;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::all();
        return MedicoResource::collection($medicos);
    }

    public function bycidade(int $cidade_id)
    {
        $medicos = Medico::where('cidade_id',$cidade_id)->get();
        return MedicoResource::collection($medicos);
    }


    public function pacientes(int $medico_id)
    {
        if ( !$medico = Medico::with('pacientes')->find($medico_id) )
            return response()->json(['message'=>'Medico not found!'],404);

        return new MedicoResource($medico);
    }
}
