<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta extends Model
{
    use HasFactory;
    protected $table ="consulta";
    protected $fillable = [
        'profissional_saude_id','inicio_atendimento','fim_atendimento','estado',
        'data_atendimento',	'solicitar_retorno','paciente_id','descricao','servicos_medicos_id',
    ];
//
    public function profissional_saude()
    {
        return $this->belongsTo(profissional_saude::class);
    }

   public function paciente()
   {
    return $this->belongsTo(Paciente::class,'paciente_id');
   }


   public function anamnese()
   {
       return $this->hasOne(anamnese::class,'consulta_id');

   }

   public function examesFisicos()
   {
       return $this->hasOne(exame_fisico::class,'consulta_id');
   }
    public function hepotise()
    {
       return $this->hasOne(hepotise_diagnostica::class,'consulta_id');
    }

    public function prescricao()
    {
       return $this->hasOne(prescricoes::class,'consulta_id');
    }

    public function servico()
    {
        # code...

        return $this->belongsTo(servicos_medicos::class,'servicos_medicos_id');
    }


}
