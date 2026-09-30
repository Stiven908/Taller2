@extends('layouts.app')
@section('titulo', 'Factura')

@section('content')
<div class="card">
  <h2>Factura N° {{ str_pad($compra->id, 6, '0', STR_PAD_LEFT) }}</h2>
  <p><strong>Cliente:</strong> {{ $compra->user->name }}</p>
  <p><strong>Fecha:</strong> {{ $compra->created_at->format('d/m/Y H:i') }}</p>

  <table>
    <thead>
      <tr><th>Producto</th><th>Cant.</th><th>Precio</th><th>Subtotal</th></tr>
    </thead>
    <tbody>
      @foreach($compra->items as $item)
        <tr>
          <td>{{ $item->producto->nombre }}</td>
          <td>{{ $item->cantidad }}</td>
          <td>${{ number_format($item->precio_unitario, 2) }}</td>
          <td>${{ number_format($item->cantidad * $item->precio_unitario, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="total-linea">
    <span>Total</span>
    <span>${{ number_format($compra->total, 2) }}</span>
  </div>
</div>
@endsection
