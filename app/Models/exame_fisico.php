<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exame_fisico extends Model
{
    use HasFactory;
    protected $table = "exame_fisico";
    protected $fillable = [
        'consulta_id',	'prontuario_id','peso',	'altura','pressao_arterial_sistolica'
         ,'pressao_arterial_diastolica','frequencia_cardiaca','observacao_gerais',
    ];
    public function prontuario()
    {
        return  $this->belongsTo(prontuario::class);
    }
  public function consulta()
  {
    return  $this->belongsTo(consulta::class);
  }
}
