<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicoResource;
use App\Models\Medico;
use Illuminate\Http\Request;

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
}
