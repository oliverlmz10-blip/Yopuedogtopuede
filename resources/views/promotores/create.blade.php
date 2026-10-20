@extends('layouts.app')
@section('titulo', 'Nuevo Promotor')
@section('contenido')

    <h1 class="text-xl font-black uppercase mb-6">Nuevo promotor</h1>

    <form action="{{ route('promotores.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-md">
        @csrf
        <label class="block text-xs font-bold uppercase mb-1">Región</label>
        <select name="region_id" class="w-full border rounded p-2 mb-4">
            <option value="">Selecciona una región</option>
            @foreach($regiones as $region)
                <option value="{{ $region->id }}">{{ $region->nombre }}</option>
            @endforeach
        </select>

        <label class="block text-xs font-bold uppercase mb-1">Nombre completo</label>
        <input type="text" name="nombre_completo" class="w-full border rounded p-2 mb-4" value="{{ old('nombre_completo') }}">

        <label class="block text-xs font-bold uppercase mb-1">Estatus</label>
        <input type="text" name="estatus" class="w-full border rounded p-2 mb-4" value="{{ old('estatus') }}">

        <button class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">Guardar</button>
        <a href="{{ route('promotores.index') }}" class="ml-2 text-xs font-bold uppercase">Cancelar</a>
    </form>

@endsection
