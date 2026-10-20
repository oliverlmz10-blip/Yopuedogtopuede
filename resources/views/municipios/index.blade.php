@extends('layouts.app')
@section('titulo', 'Municipios')
@section('contenido')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-black uppercase">Municipios</h1>
        <a href="{{ route('municipios.create') }}" class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">
            Nuevo municipio
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="text-left text-xs uppercase border-b">
                <th class="p-3">ID</th>
                <th class="p-3">Nombre</th>
                <th class="p-3">Región</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($municipios as $municipio)
                <tr class="border-b">
                    <td class="p-3">{{ $municipio->id }}</td>
                    <td class="p-3">{{ $municipio->nombre }}</td>
                    <td class="p-3">{{ $municipio->region->nombre ?? '-' }}</td>
                    <td class="p-3">
                        <a href="{{ route('municipios.edit', $municipio) }}" class="text-blue-600 text-xs font-bold">Editar</a>
                        <form action="{{ route('municipios.destroy', $municipio) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 text-xs font-bold ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-stone-400">No hay municipios registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
