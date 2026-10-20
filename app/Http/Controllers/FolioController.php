<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Grupo;
use App\Models\Promotor;
use Illuminate\Http\Request;

class FolioController extends Controller
{
    // Vista con filtros para elegir qué imprimir
    public function index(Request $request)
    {
        $grupos = Grupo::all();
        $promotores = Promotor::all();

        return view('folios.index', compact('grupos', 'promotores'));
    }

    // Imprimir la solicitud de un solo beneficiario
    public function imprimirIndividual(Beneficiario $beneficiario)
    {
        return view('folios.imprimir', compact('beneficiario'));
    }

    // Imprimir varias solicitudes filtradas por grupo o promotor
    public function imprimirMasivo(Request $request)
    {
        $query = Beneficiario::with('grupo');

        if ($request->filled('grupo_id')) {
            $query->where('grupo_id', $request->grupo_id);
        }

        if ($request->filled('promotor_id')) {
            $query->whereHas('grupo', function ($q) use ($request) {
                $q->where('promotor_id', $request->promotor_id);
            });
        }

        $beneficiarios = $query->get();

        return view('folios.imprimir-masivo', compact('beneficiarios'));
    }

    // Los métodos create, store, show, edit, update, destroy
    // que Laravel generó automáticamente puedes borrarlos,
    // ya que este módulo no crea/edita/elimina folios, solo imprime.
}
