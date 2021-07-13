<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hepotise_diagnostica extends Model
{
    use HasFactory;
    protected $table = "hepotise_diagnostica";
//
protected $fillable = [
    'consulta_id','prontuario_id','hipotise','tipo_exame','diagnostico_final',
     'solicitar_exame',	'requer_iternacao',	'reque_urgencia',
];

public function prontuario()
    {
        return  $this->belongsTo(prontuario::class);
    }
  public function consulta()
  {
    return  $this->belongsTo(consulta::class);
  }

  public function exames()
  {
      return $this->hasMany(exame::class,'hepotise_diagnostica_id','id');
  }
}
