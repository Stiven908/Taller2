<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>@yield('titulo', 'La Comercial')</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="topbar">
  <h1>La Comercial</h1>
  <nav>
    @auth
      <a href="{{ route('tienda') }}">Tienda</a>
      <a href="{{ route('compras.index') }}">Mis compras</a>
      @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.historial') }}">Historial (admin)</a>
        <a href="{{ route('admin.productos') }}">Productos (admin)</a>
      @endif
      <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit">Salir</button>
      </form>
    @endauth
  </nav>
</div>

<main>
  @if(session('mensaje'))
    <div class="card" style="border-color:#3c5c48">{{ session('mensaje') }}</div>
  @endif
  @if(session('error'))
    <p class="error">{{ session('error') }}</p>
  @endif

  @yield('content')
</main>
</body>
</html>
