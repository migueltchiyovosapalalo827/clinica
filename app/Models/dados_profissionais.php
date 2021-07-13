<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dados_profissionais extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'tipo_conselho','numero_registro','profissao','especialidade',	
    ];

    public function profissional()
    {
        return $this->hasOne(profissional_saude::class,'dados_profissionais_id');
    }
}
