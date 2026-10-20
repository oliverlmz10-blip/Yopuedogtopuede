@extends('layouts.app')
@section('titulo', 'Nueva Región')
@section('contenido')

    <h1 class="text-xl font-black uppercase mb-6">Nueva región</h1>

    <form action="{{ route('regiones.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-md">
        @csrf
        <label class="block text-xs font-bold uppercase mb-1">Nombre</label>
        <input type="text" name="nombre" class="w-full border rounded p-2 mb-4" value="{{ old('nombre') }}">

        <button class="px-4 py-2 bg-black text-white rounded text-xs font-black uppercase">Guardar</button>
        <a href="{{ route('regiones.index') }}" class="ml-2 text-xs font-bold uppercase">Cancelar</a>
    </form>

@endsection
