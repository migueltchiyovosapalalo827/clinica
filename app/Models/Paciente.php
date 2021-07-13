<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

  protected $table = 'pacientes';
    protected $fillable = [
        'prontuario_id','user_id','dados_complementares_id',
    ];
    public function user()
     {
        return  $this->belongsTo(User::class,'user_id');
     }

public function consultas()
{
    return $this->hasMany(consulta::class,'paciente_id');
}

public function prontuario()
{
    return   $this->belongsTo(prontuario::class);
}

 public function dados_complementar()
 {
     # code...
    return $this->belongsTo(dados_complementar::class,'dados_complementares_id');
 }

}
