<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Grupo;
use App\Models\Promotor;
use App\Models\Region;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;

class IdseController extends Controller
{
    // Buscador con filtros dinámicos: grupo, promotor, región, folio, individuo
    public function index(Request $request)
    {
        $query = Beneficiario::with('grupo.promotor', 'grupo.municipio.region');

        if ($request->filled('folio')) {
            $query->where('folio', $request->folio);
        }

        if ($request->filled('curp')) {
            $query->where('curp', 'like', '%' . $request->curp . '%');
        }

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('grupo_id')) {
            $query->where('grupo_id', $request->grupo_id);
        }

        if ($request->filled('promotor_id')) {
            $query->whereHas('grupo', function ($q) use ($request) {
                $q->where('promotor_id', $request->promotor_id);
            });
        }

        if ($request->filled('region_id')) {
            $query->whereHas('grupo.municipio', function ($q) use ($request) {
                $q->where('region_id', $request->region_id);
            });
        }

        $beneficiarios = $query->paginate(20);

        $grupos = Grupo::all();
        $promotores = Promotor::all();
        $regiones = Region::all();

        return view('idse.index', compact('beneficiarios', 'grupos', 'promotores', 'regiones'));
    }

    // Ficha individual del beneficiario
    public function show(Beneficiario $beneficiario)
    {
        return view('idse.show', compact('beneficiario'));
    }

    // Actualizar estatus (genera ticket de auditoría)
    public function update(Request $request, Beneficiario $beneficiario)
    {
        $datosAnteriores = $beneficiario->toArray();

        $request->validate([
            'estatus' => 'required|string',
        ]);

        $beneficiario->update([
            'estatus' => $request->estatus,
        ]);

        AuditoriaService::registrar(
            'beneficiarios',
            $beneficiario->id,
            'actualizacion_estatus',
            $datosAnteriores,
            $beneficiario->toArray()
        );

        return redirect()->route('idse.show', $beneficiario)
            ->with('success', 'Estatus actualizado correctamente.');
    }
}
