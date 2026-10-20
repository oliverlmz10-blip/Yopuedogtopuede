<?php

namespace App\Services;

use App\Models\BitacoraAuditoria;

class AuditoriaService
{
    public static function registrar($tabla, $registroId, $accion, $anteriores = null, $nuevos = null)
    {
        BitacoraAuditoria::create([
            'ticket_id'          => uniqid('TCK-'),
            'usuario_responsable' => auth()->user()->name ?? 'Sistema',
            'tabla_afectada'     => $tabla,
            'registro_id'        => $registroId,
            'accion'             => $accion,
            'datos_anteriores'   => json_encode($anteriores),
            'datos_nuevos'       => json_encode($nuevos),
        ]);
    }
}
