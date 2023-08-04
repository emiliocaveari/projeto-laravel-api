<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';

    protected $fillable = [
        'nome',
        'especialidade',
        'cidade_id',
    ];


    public function cidade() : HasOne
    {
        return $this->hasOne(Cidade::class,'id','cidade_id');
    }


    public function pacientes() : BelongsToMany
    {
        return $this
            ->belongsToMany(Paciente::class,'medico_paciente','medico_id','paciente_id')
            ->withTimestamps();
    }
    
}
