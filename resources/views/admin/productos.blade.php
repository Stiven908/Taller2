@extends('layouts.app')
@section('titulo', 'Productos (admin)')

@section('content')
<div class="card">
  <h2>Productos</h2>
  <p><a href="{{ route('admin.productos.crear') }}">+ Agregar producto nuevo</a></p>

  @forelse($productos as $producto)
    <div class="producto">
      <div>
        <strong>{{ $producto->nombre }}</strong>
        <span style="color:#888; font-size:0.85rem"> · {{ $producto->categoria }}</span><br>
        <span class="precio">${{ number_format($producto->precio, 2) }}</span>
        <span style="color:#888; font-size:0.85rem"> · stock: {{ $producto->stock }}</span>
      </div>
    </div>
  @empty
    <p>No hay productos todavía.</p>
  @endforelse
</div>
@endsection
