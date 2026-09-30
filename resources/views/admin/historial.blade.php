@extends('layouts.app')
@section('titulo', 'Historial de compras (admin)')

@section('content')
<div class="card">
  <h2>Historial de compras</h2>

  @if(count($compras) === 0)
    <p>Todavía no hay compras registradas.</p>
  @else
    <table>
      <thead>
        <tr><th>#</th><th>Cliente</th><th>Fecha</th><th>Total</th><th>Detalle</th></tr>
      </thead>
      <tbody>
        @foreach($compras as $compra)
          <tr>
            <td>{{ $compra->id }}</td>
            <td>{{ $compra->user->name }}</td>
            <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
            <td>${{ number_format($compra->total, 2) }}</td>
            <td><a href="{{ route('compras.factura', $compra->id) }}">Ver</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
