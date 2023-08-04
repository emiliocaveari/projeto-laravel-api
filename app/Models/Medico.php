<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';


    public function cidade() : HasOne
    {
        return $this->hasOne(Cidade::class,'id','cidade_id');
    }
    
}
