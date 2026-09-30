@extends('layouts.app')
@section('titulo', 'Mis compras')

@section('content')
<div class="card">
  <h2>Mis compras</h2>

  @forelse($compras as $compra)
    <div class="producto">
      <div>Compra #{{ $compra->id }} · {{ $compra->created_at->format('d/m/Y') }}</div>
      <div>
        <span class="precio">${{ number_format($compra->total, 2) }}</span>
        <a href="{{ route('compras.factura', $compra->id) }}" style="margin-left:0.6rem">Ver factura</a>
      </div>
    </div>
  @empty
    <p>Todavía no has hecho ninguna compra.</p>
  @endforelse
</div>
@endsection
