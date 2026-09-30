@extends('layouts.app')
@section('titulo', 'Catálogo')

@section('content')
<div class="card">
  <h2>Catálogo</h2>

  @forelse($productos as $producto)
    <div class="producto">
      <div>
        <strong>{{ $producto->nombre }}</strong><br>
        <span class="precio">${{ number_format($producto->precio, 2) }}</span>
        <span style="color:#888; font-size:0.85rem"> · stock: {{ $producto->stock }}</span>
      </div>
      <form method="POST" action="{{ route('carrito.agregar', $producto->id) }}" style="display:flex; align-items:center">
        @csrf
        <input type="number" name="cantidad" class="cantidad-input" min="1" max="{{ $producto->stock }}" value="1">
        <button class="primary" type="submit">Agregar</button>
      </form>
    </div>
  @empty
    <p>No hay productos disponibles.</p>
  @endforelse
</div>

<p><a href="{{ route('carrito') }}">Ver carrito →</a></p>
@endsection
