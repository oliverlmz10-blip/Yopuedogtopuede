<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitacoraAuditoria extends Model
{
    const UPDATED_AT = null; // esta tabla solo tiene created_at

    protected $fillable = [
        'ticket_id',
        'usuario_responsable',
        'tabla_afectada',
        'registro_id',
        'accion',
        'datos_anteriores',
        'datos_nuevos',
    ];
}
