<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profissional_saude extends Model
{
    use HasFactory;
    protected $fillable = [
        'dados_profissionais_id',
    ];

    protected  $table = 'profissional_saude';
    public function servicos()
    {
        return $this->belongsToMany(servicos_medicos::class,'servicos_profissionais',	'profissional_saude_id','servicos_medico_id');
    }

    public function dadosProfissionais()
    {
        return $this->belongsTo(dados_profissionais::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function consulta()
    {
        # code...
        return $this->hasMany(consulta::class);
    }
}
