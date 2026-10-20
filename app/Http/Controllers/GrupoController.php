<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Municipio;
use App\Models\Promotor;
use App\Services\AuditoriaService;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with('promotor', 'municipio')->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $promotores = Promotor::all();
        $municipios = Municipio::all();
        return view('grupos.create', compact('promotores', 'municipios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'promotor_id' => 'required|exists:promotores,id',
            'municipio_id' => 'required|exists:municipios,id',
            'identificador_grupo' => 'required|string',
            'grupo_inicial' => 'required|integer',
            'grupo_final' => 'required|integer',
            'lugar_fecha_evento' => 'required|string',
        ]);

        $grupo = Grupo::create($request->all());

        AuditoriaService::registrar('grupos', $grupo->id, 'creacion', null, $grupo->toArray());

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    public function show(Grupo $grupo)
    {
        return view('grupos.show', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {
        $promotores = Promotor::all();
        $municipios = Municipio::all();
        return view('grupos.edit', compact('grupo', 'promotores', 'municipios'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $datosAnteriores = $grupo->toArray();

        $grupo->update($request->all());

        AuditoriaService::registrar('grupos', $grupo->id, 'actualizacion', $datosAnteriores, $grupo->toArray());

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(Grupo $grupo)
    {
        AuditoriaService::registrar('grupos', $grupo->id, 'eliminacion', $grupo->toArray(), null);

        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente.');
    }
}
