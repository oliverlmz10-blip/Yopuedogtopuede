<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $fillable = [
        'grupo_id',
        'folio',
        'curp',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'estatus',
        'anio_padron',
        'fecha_termino',
        'fecha_asignacion',
        'tot_asistencias',
        'porc_avance',
        'respuesta_aprendizajes_cambio',
        'observaciones',
    ];

    public function grupo() { return $this->belongsTo(Grupo::class); }
}
