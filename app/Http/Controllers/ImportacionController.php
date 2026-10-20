<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportacionController extends Controller
{
    private string $disco = 'local';
    private string $carpeta = 'importaciones';

    // Formulario de subida + listado de archivos ya cargados
    public function index()
    {
        $archivos = collect(Storage::disk($this->disco)->files($this->carpeta))
            ->map(fn ($ruta) => [
                'nombre'    => basename($ruta),
                'tamano'    => Storage::disk($this->disco)->size($ruta),
                'fecha'     => Storage::disk($this->disco)->lastModified($ruta),
            ])
            ->sortByDesc('fecha')
            ->values();

        return view('importaciones.index', compact('archivos'));
    }

    // Guardar el Excel subido
    public function store(Request $request)
    {
        $request->validate([
            'archivo' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'], // máx. 10 MB
        ], [
            'archivo.required' => 'Selecciona un archivo de Excel.',
            'archivo.mimes'    => 'El archivo debe ser .xlsx, .xls o .csv.',
            'archivo.max'      => 'El archivo no debe pasar de 10 MB.',
        ]);

        $archivo = $request->file('archivo');

        // Nombre único para evitar sobrescribir: 20260928_153000_nombre.xlsx
        $nombre = now()->format('Ymd_His') . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $archivo->getClientOriginalName());

        $archivo->storeAs($this->carpeta, $nombre, $this->disco);

        return redirect()
            ->route('importaciones.index')
            ->with('success', 'Archivo "' . $archivo->getClientOriginalName() . '" subido correctamente.');
    }

    // Ver / descargar el archivo
    public function show(string $archivo)
    {
        $ruta = $this->carpeta . '/' . basename($archivo); // basename evita path traversal

        abort_unless(Storage::disk($this->disco)->exists($ruta), 404);

        return Storage::disk($this->disco)->download($ruta);
    }
}
