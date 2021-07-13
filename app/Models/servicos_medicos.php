<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicos_medicos extends Model
{
    use HasFactory;
    protected $table = "servicos_medicos";

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function equipaMedica()
    {
       return $this->belongsToMany(profissional_saude::class,'servicos_profissionais','profissional_saude_id','servicos_medico_id');
    }


     public function consulta()
    {
        return $this->hasOne(consulta::class,'servicos_medicos_id');
    }
}
