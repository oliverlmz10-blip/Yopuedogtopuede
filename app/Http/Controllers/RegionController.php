<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regiones = Region::all();
        return view('regiones.index', compact('regiones'));
    }

    public function create()
    {
        return view('regiones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        Region::create($request->all());

        return redirect()->route('regiones.index')->with('success', 'Región creada correctamente.');
    }

    public function show(Region $region)
    {
        return view('regiones.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('regiones.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $region->update($request->all());

        return redirect()->route('regiones.index')->with('success', 'Región actualizada correctamente.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regiones.index')->with('success', 'Región eliminada correctamente.');
    }
}
