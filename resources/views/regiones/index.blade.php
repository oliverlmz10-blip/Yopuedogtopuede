@extends('layouts.app')
@section('titulo', 'Regiones')
@section('contenido')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-black uppercase">Regiones</h1>
        <a href="{{ route('regiones.create') }}" class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">
            Nueva región
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
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($regiones as $region)
                <tr class="border-b">
                    <td class="p-3">{{ $region->id }}</td>
                    <td class="p-3">{{ $region->nombre }}</td>
                    <td class="p-3">
                        <a href="{{ route('regiones.edit', $region) }}" class="text-blue-600 text-xs font-bold">Editar</a>
                        <form action="{{ route('regiones.destroy', $region) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 text-xs font-bold ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-stone-400">No hay regiones registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
