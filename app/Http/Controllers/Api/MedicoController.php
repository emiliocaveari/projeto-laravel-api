<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicoRequest;
use App\Http\Resources\MedicoResource;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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


    public function store(StoreMedicoRequest $request)
    {
        $data = $request->validated();

        if ( !$medico = Medico::create($data) )
            return response()->json(['message'=>'Unable to create new record'],500);

        return new MedicoResource($medico);
    }


    public function pacientesync(int $medico_id, Request $request)
    {
        //--Validation
        $data = $request->validate([
            'paciente_id' => 'required|exists:paciente,id',
            'medico_id' => 'required|exists:medico,id',
        ]);

        //--Validate URL param with request param
        if ( $medico_id != $request->medico_id){
            return response()->json(['error'=>'Invalid request','message'=>'URL parameter and body not match!'],400);
        }
        
        //--Sync Has Many
        $medico = Medico::find($request->medico_id);
        $medico->pacientes()->sync([ $request->paciente_id ], false);
        
        //--Load Paciente
        $medico->load([
            'pacientes'=> fn($query)=> $query->where('paciente_id',$request->paciente_id)
        ]);

        return new MedicoResource($medico);
    }
}
