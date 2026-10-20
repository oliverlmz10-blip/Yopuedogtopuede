<?php

namespace App\Http\Controllers;

use App\Models\Promotor;
use App\Models\Region;
use Illuminate\Http\Request;

class PromotorController extends Controller
{
    public function index()
    {
        $promotores = Promotor::with('region')->get();
        return view('promotores.index', compact('promotores'));
    }

    public function create()
    {
        $regiones = Region::all();
        return view('promotores.create', compact('regiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'region_id' => 'required|exists:regiones,id',
            'nombre_completo' => 'required|string',
            'estatus' => 'required|string',
        ]);

        Promotor::create($request->all());

        return redirect()->route('promotores.index')->with('success', 'Promotor creado correctamente.');
    }

    public function show(Promotor $promotor)
    {
        return view('promotores.show', compact('promotor'));
    }

    public function edit(Promotor $promotor)
    {
        $regiones = Region::all();
        return view('promotores.edit', compact('promotor', 'regiones'));
    }

    public function update(Request $request, Promotor $promotor)
    {
        $promotor->update($request->all());
        return redirect()->route('promotores.index')->with('success', 'Promotor actualizado correctamente.');
    }

    public function destroy(Promotor $promotor)
    {
        $promotor->delete();
        return redirect()->route('promotores.index')->with('success', 'Promotor eliminado correctamente.');
    }
}
