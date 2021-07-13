<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exame extends Model
{
    use HasFactory;


    protected $fillable = ['hepotise_diagnostica_id','nome_exame','material_analizado','finalidade','preparacao_previa'	,
    'valor_normais_descricao','valor_arormaais_segnifica','nivel_confiablidade',	'descricao_exame',	'prazo_resultado'];


    public function hipotise()
    {
        return $this->belongsTo(hepotise_diagnostica::class,'hepotise_diagnostica_id');
    }
}
