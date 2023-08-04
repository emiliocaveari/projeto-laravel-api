<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    
    public function index()
    {
        $cidades = Cidade::all();
        return $cidades->toArray();
    }
}
