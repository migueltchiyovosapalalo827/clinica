<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dados_familiar extends Model
{
    use HasFactory;

 
 
protected  $table = 'dados_familiares';

 protected $fillable = ['nome','telefone','idade','parentesco','email'];

 public function dadosComplementar()
 {
    return  $this->belongsTo(dados_complementar::class);
 }
}
