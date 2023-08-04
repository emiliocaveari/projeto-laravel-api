<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicoResource;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    
    public function index()
    {
        $cidades = Cidade::all();
        return $cidades->toArray();
    }

    public function medicos(int $cidade_id)
    {
        if (!$cidade = Cidade::find($cidade_id)) 
            return response()->json(['message' => 'Cidade not found!'],404);

        return MedicoResource::collection($cidade->medicos);
    }

}
