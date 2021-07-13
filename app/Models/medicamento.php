<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicamento extends Model
{
    use HasFactory;
    protected $table = "medicamentos";
    protected $fillable  = ['prescricoes_id','nome_medicamento','apresentacao','unidade','valor','posologia'];

    public function prescricao()
    {
        return $this->belongsTo(prescricoes::class);
    }
}
