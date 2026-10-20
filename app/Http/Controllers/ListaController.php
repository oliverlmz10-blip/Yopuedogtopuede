<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Grupo;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function index(Request $request)
    {
        $grupos = Grupo::all();

        return view('listas.index', compact('grupos'));
    }

    // Genera la lista filtrada por CURP, nombre, folio, grupo, promotor y clasificada
    // en graduados / pendientes según el campo que definas para eso (ej: porc_avance)
    public function generar(Request $request)
    {
        $query = Beneficiario::with('grupo.promotor');

        if ($request->filled('curp')) {
            $query->where('curp', 'like', '%' . $request->curp . '%');
        }

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('folio_inicio') && $request->filled('folio_fin')) {
            $query->whereBetween('folio', [$request->folio_inicio, $request->folio_fin]);
        }

        if ($request->filled('grupo_id')) {
            $query->where('grupo_id', $request->grupo_id);
        }

        if ($request->filled('promotor_id')) {
            $query->whereHas('grupo', function ($q) use ($request) {
                $q->where('promotor_id', $request->promotor_id);
            });
        }

        // Clasificación graduado / pendiente
        if ($request->filled('clasificacion')) {
            if ($request->clasificacion === 'graduados') {
                $query->where('porc_avance', '>=', 100);
            } elseif ($request->clasificacion === 'pendientes') {
                $query->where('porc_avance', '<', 100);
            }
        }

        $beneficiarios = $query->get();

        return view('listas.resultado', compact('beneficiarios'));
    }
}
