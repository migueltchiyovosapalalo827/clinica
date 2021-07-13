<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dados_complementar extends Model
{
    use HasFactory;

    protected  $table = 'dados_complementares';
    protected $fillable = ['naturalidade','estadocivil','profissao','escolaridade'];

    public function pacientes()
    {
        return $this->hasOne(Paciente::class,'dados_complementares_id');
    }

    public function dadosFamiliares()
    {
      return  $this->hasMany(dados_familiar::class,'dados_complementares_id');
    }
}
