@extends('layouts.app')
@section('titulo', 'Editar Municipio')
@section('contenido')

    <h1 class="text-xl font-black uppercase mb-6">Editar municipio</h1>

    <form action="{{ route('municipios.update', $municipio) }}" method="POST" class="bg-white p-6 rounded shadow max-w-md">
        @csrf @method('PUT')
        <label class="block text-xs font-bold uppercase mb-1">Región</label>
        <select name="region_id" class="w-full border rounded p-2 mb-4">
            @foreach($regiones as $region)
                <option value="{{ $region->id }}" {{ $municipio->region_id == $region->id ? 'selected' : '' }}>
                    {{ $region->nombre }}
                </option>
            @endforeach
        </select>

        <label class="block text-xs font-bold uppercase mb-1">Nombre</label>
        <input type="text" name="nombre" class="w-full border rounded p-2 mb-4" value="{{ $municipio->nombre }}">

        <button class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">Actualizar</button>
        <a href="{{ route('municipios.index') }}" class="ml-2 text-xs font-bold uppercase">Cancelar</a>
    </form>

@endsection
