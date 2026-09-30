@extends('layouts.app')
@section('titulo', 'Nuevo producto')

@section('content')
<div class="card">
  <h2>Nuevo producto</h2>

  <form method="POST" action="{{ route('admin.productos.store') }}">
    @csrf
    <div class="form-group">
      <label>Nombre</label>
      <input type="text" name="nombre" value="{{ old('nombre') }}" required>
    </div>
    <div class="form-group">
      <label>Descripción</label>
      <input type="text" name="descripcion" value="{{ old('descripcion') }}">
    </div>
    <div class="form-group">
      <label>Categoría</label>
      <input type="text" name="categoria" value="{{ old('categoria') }}" placeholder="Ropa, Alimentos, Hogar...">
    </div>
    <div class="form-group">
      <label>Precio</label>
      <input type="number" name="precio" step="0.01" min="0" value="{{ old('precio') }}" required>
    </div>
    <div class="form-group">
      <label>Stock</label>
      <input type="number" name="stock" min="0" value="{{ old('stock') }}" required>
    </div>
    <button class="primary" type="submit">Crear producto</button>
  </form>

  @if($errors->any())
    @foreach($errors->all() as $error)
      <p class="error">{{ $error }}</p>
    @endforeach
  @endif

  <p style="margin-top:1rem"><a href="{{ route('admin.productos') }}">← Volver al listado</a></p>
</div>
@endsection
