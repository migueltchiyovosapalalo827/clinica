<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prontuario extends Model
{
    use HasFactory;

    protected  $table = 'prontuario';

    public function anamnese()
    {
        return $this->hasMany(anamnese::class);

    }

    public function examesFisicos()
    {
        return $this->hasMany(exame_fisico::class,'prontuario_id');
    }
     public function hepotise()
     {
        return $this->hasMany(hepotise_diagnostica::class,'prontuario_id');
     }

     public function prescricao()
     {
        return $this->hasMany(prescricoes::class,'prontuario_id');
     }

     public function paciente()
     {
         return  $this->hasOne(Paciente::class,'prontuario_id');
     }

    }
