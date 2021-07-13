<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dados_pessoais extends Model
{
    use HasFactory;
    protected  $table = "dados_pessoais";
    protected $fillable = [
      'nome','data_nasc','sexo','bi',	'telefone','telefone_secundario',
      'nacionalidade','provincia','municipio', 'bairro','email',
  ];
    // buscar usuarios

     public function user()
     {
        return  $this->belongsTo(User::class,'user_id');
     }
}
