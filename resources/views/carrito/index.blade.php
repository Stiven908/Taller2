@extends('layouts.app')
@section('titulo', 'Carrito')

@section('content')
<div class="card">
  <h2>Carrito</h2>

  @if(count($items) === 0)
    <p>Tu carrito está vacío.</p>
  @else
    @foreach($items as $item)
      <div class="producto">
        <div>{{ $item['producto']->nombre }} × {{ $item['cantidad'] }}</div>
        <div>
          <span class="precio">${{ number_format($item['subtotal'], 2) }}</span>
          <form method="POST" action="{{ route('carrito.quitar', $item['producto']->id) }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" style="margin-left:0.6rem">✕</button>
          </form>
        </div>
      </div>
    @endforeach

    <div class="total-linea">
      <span>Total</span>
      <span>${{ number_format($total, 2) }}</span>
    </div>

    <form method="POST" action="{{ route('compras.store') }}" style="margin-top:1rem">
      @csrf
      <button class="primary" type="submit">Confirmar compra</button>
    </form>
  @endif
</div>

<p><a href="{{ route('tienda') }}">← Seguir comprando</a></p>
@endsection
