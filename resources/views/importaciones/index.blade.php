@extends('layouts.app')
@section('titulo', 'Importar Excel')
@section('contenido')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-black uppercase">Importar Excel</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('importaciones.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded shadow p-6 mb-8 max-w-xl">
        @csrf
        <label for="archivo" class="block text-xs font-black uppercase mb-2">
            Archivo de Excel (.xlsx, .xls, .csv)
        </label>
        <input type="file" name="archivo" id="archivo" accept=".xlsx,.xls,.csv" required
               class="block w-full text-sm border border-stone-300 rounded p-2 mb-4
                      file:mr-4 file:py-2 file:px-4 file:rounded file:border-0
                      file:bg-black file:text-white file:text-xs file:font-black file:uppercase">
        <button type="submit" class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">
            Subir archivo
        </button>
    </form>

    <h2 class="text-sm font-black uppercase mb-3">Archivos subidos</h2>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="text-left text-xs uppercase border-b">
                <th class="p-3">Archivo</th>
                <th class="p-3">Tamaño</th>
                <th class="p-3">Fecha</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archivos as $a)
                <tr class="border-b">
                    <td class="p-3">{{ $a['nombre'] }}</td>
                    <td class="p-3">{{ number_format($a['tamano'] / 1024, 1) }} KB</td>
                    <td class="p-3">{{ \Carbon\Carbon::createFromTimestamp($a['fecha'])->format('d/m/Y H:i') }}</td>
                    <td class="p-3">
                        <a href="{{ route('importaciones.show', $a['nombre']) }}" class="text-blue-600 text-xs font-bold">
                            Ver / descargar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-stone-400">No hay archivos subidos</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
