<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescricoes extends Model
{
    use HasFactory;
    protected $table = 'prescricoes';
    protected $fillable  = ['consulta_id','prontuario_id','descricao'];

    public function prontuario()
    {
        return  $this->belongsTo(prontuario::class);
    }
  public function consulta()
  {
    return  $this->belongsTo(consulta::class);
  }

  public function medicamentos()
  {
    return $this->hasMany(medicamento::class,'prescricoes_id');
  }
}
