<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Yo Puedo, Guanajuato Puede')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5DC] antialiased font-sans min-h-screen flex">

    <aside class="w-64 bg-white border-r border-stone-200 min-h-screen p-4">
        <h1 class="text-lg font-black uppercase mb-8">Yo Puedo</h1>
        <nav class="flex flex-col gap-2 text-sm font-bold uppercase">
            <a href="{{ route('idse.index') }}" class="p-2 rounded hover:bg-black hover:text-white">IDSE</a>
            <a href="{{ route('folios.index') }}" class="p-2 rounded hover:bg-black hover:text-white">Folios</a>
            <a href="{{ route('listas.index') }}" class="p-2 rounded hover:bg-black hover:text-white">Listas</a>
            <a href="{{ route('reconocimientos.index') }}" class="p-2 rounded hover:bg-black hover:text-white">Reconocimientos</a>
            <a href="{{ route('grupos.index') }}" class="p-2 rounded hover:bg-black hover:text-white">Grupos</a>
            <a href="{{ route('importaciones.index') }}" class="p-2 rounded hover:bg-black hover:text-white">Importar</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        @yield('contenido')
    </main>

</body>
</html>
