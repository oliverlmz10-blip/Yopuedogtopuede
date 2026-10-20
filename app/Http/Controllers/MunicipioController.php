<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\Region;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipios = Municipio::with('region')->get();
        return view('municipios.index', compact('municipios'));
    }

    public function create()
    {
        $regiones = Region::all();
        return view('municipios.create', compact('regiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'region_id' => 'required|exists:regiones,id',
            'nombre' => 'required|string',
        ]);

        Municipio::create($request->all());

        return redirect()->route('municipios.index')->with('success', 'Municipio creado correctamente.');
    }

    public function show(Municipio $municipio)
    {
        return view('municipios.show', compact('municipio'));
    }

    public function edit(Municipio $municipio)
    {
        $regiones = Region::all();
        return view('municipios.edit', compact('municipio', 'regiones'));
    }

    public function update(Request $request, Municipio $municipio)
    {
        $request->validate([
            'region_id' => 'required|exists:regiones,id',
            'nombre' => 'required|string',
        ]);

        $municipio->update($request->all());

        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado correctamente.');
    }

    public function destroy(Municipio $municipio)
    {
        $municipio->delete();
        return redirect()->route('municipios.index')->with('success', 'Municipio eliminado correctamente.');
    }
}
