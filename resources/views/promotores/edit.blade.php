@extends('layouts.app')
@section('titulo', 'Editar Promotor')
@section('contenido')

    <h1 class="text-xl font-black uppercase mb-6">Editar promotor</h1>

    <form action="{{ route('promotores.update', $promotor) }}" method="POST" class="bg-white p-6 rounded shadow max-w-md">
        @csrf @method('PUT')
        <label class="block text-xs font-bold uppercase mb-1">Región</label>
        <select name="region_id" class="w-full border rounded p-2 mb-4">
            @foreach($regiones as $region)
                <option value="{{ $region->id }}" {{ $promotor->region_id == $region->id ? 'selected' : '' }}>
                    {{ $region->nombre }}
                </option>
            @endforeach
        </select>

        <label class="block text-xs font-bold uppercase mb-1">Nombre completo</label>
        <input type="text" name="nombre_completo" class="w-full border rounded p-2 mb-4" value="{{ $promotor->nombre_completo }}">

        <label class="block text-xs font-bold uppercase mb-1">Estatus</label>
        <input type="text" name="estatus" class="w-full border rounded p-2 mb-4" value="{{ $promotor->estatus }}">

        <button class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">Actualizar</button>
        <a href="{{ route('promotores.index') }}" class="ml-2 text-xs font-bold uppercase">Cancelar</a>
    </form>

@endsection
