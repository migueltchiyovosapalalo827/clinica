<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anamnese extends Model
{
    use HasFactory;



    protected $table ="anamnese";
    protected $fillable = [
        'consulta_id','prontuario_id',
        'queixa_principal',	'problemas_renais',	'problemas_resperatorios',	'reumastismo','alergias',
        'problemas_grasticos',	'historia',	'hepatite',	'diabetes',
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
