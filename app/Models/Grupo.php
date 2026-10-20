<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'promotor_id',
        'municipio_id',
        'identificador_grupo',
        'grupo_inicial',
        'grupo_final',
        'lugar_fecha_evento',
    ];

    public function promotor() { return $this->belongsTo(Promotor::class); }
    public function municipio() { return $this->belongsTo(Municipio::class); }
    public function beneficiarios() { return $this->hasMany(Beneficiario::class); }
}
