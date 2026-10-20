<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Grupo;
use App\Models\Promotor;
use App\Models\Region;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;

class ReconocimientoController extends Controller
{
    public function index(Request $request)
    {
        $grupos = Grupo::all();
        $promotores = Promotor::all();
        $regiones = Region::all();

        return view('reconocimientos.index', compact('grupos', 'promotores', 'regiones'));
    }

    // Reconocimiento individual
    public function individual(Beneficiario $beneficiario)
    {
        AuditoriaService::registrar(
            'beneficiarios',
            $beneficiario->id,
            'emision_reconocimiento_individual'
        );

        return view('reconocimientos.individual', compact('beneficiario'));
    }

    // Reconocimiento masivo filtrado por grupo, promotor, región, estatus
    public function masivo(Request $request)
    {
        $query = Beneficiario::with('grupo.promotor', 'grupo.municipio.region');

        if ($request->filled('grupo_id')) {
            $query->where('grupo_id', $request->grupo_id);
        }

        if ($request->filled('promotor_id')) {
            $query->whereHas('grupo', fn($q) => $q->where('promotor_id', $request->promotor_id));
        }

        if ($request->filled('region_id')) {
            $query->whereHas('grupo.municipio', fn($q) => $q->where('region_id', $request->region_id));
        }

        if ($request->filled('estatus')) {
            $query->where('estatus', $request->estatus);
        }

        $beneficiarios = $query->get();

        foreach ($beneficiarios as $beneficiario) {
            AuditoriaService::registrar(
                'beneficiarios',
                $beneficiario->id,
                'emision_reconocimiento_masivo'
            );
        }

        return view('reconocimientos.masivo', compact('beneficiarios'));
    }
}
