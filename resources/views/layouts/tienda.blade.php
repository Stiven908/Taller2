<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Tienda') · Casa Surtida</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Bricolage Grotesque', system-ui, sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">

<header class="bg-[#1B2A41] text-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3">
        <a href="{{ route('inicio') }}" class="text-xl font-extrabold tracking-tight">Casa Surtida</a>

        <nav class="flex items-center gap-1 text-sm">
            <a href="{{ route('inicio') }}" class="rounded-md px-3 py-2 hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#F5B700]">Inicio</a>
            <a href="{{ route('carrito') }}" class="rounded-md px-3 py-2 hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#F5B700]">
                Carrito
                {{-- BACKEND: reemplazar 3 por la cantidad real de ítems del carrito --}}
                <span class="ml-1 rounded-full bg-[#F5B700] px-2 py-0.5 text-xs font-semibold text-[#1B2A41]">{{ $cantidadCarrito ?? 3 }}</span>
            </a>
            {{-- BACKEND: mostrar solo si el usuario es administrador --}}
            <a href="{{ route('admin.compras') }}" class="rounded-md px-3 py-2 hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#F5B700]">Panel de ventas</a>
            <a href="{{ route('login') }}" class="ml-2 rounded-md border border-white/30 px-3 py-2 hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#F5B700]">Iniciar sesión</a>
        </nav>
    </div>
</header>

<main class="mx-auto max-w-6xl px-4 py-8">
    @if (session('exito'))
        <p class="mb-6 rounded-md bg-emerald-100 px-4 py-3 text-emerald-900" role="status">{{ session('exito') }}</p>
    @endif
    @yield('contenido')
</main>

@stack('scripts')
</body>
</html>