@extends('layouts.app')
@section('titulo', 'Crear cuenta')

@section('content')
<div class="card">
  <h2>Crear cuenta</h2>

  <form method="POST" action="{{ route('registro.post') }}">
    @csrf
    <div class="form-group">
      <label>Nombre</label>
      <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
      <label>Correo</label>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
      <label>Contraseña</label>
      <input type="password" name="password" required>
    </div>
    <button class="primary" type="submit">Crear cuenta</button>
  </form>

  @error('email')
    <p class="error">{{ $message }}</p>
  @enderror

  <p style="margin-top:1rem">
    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
  </p>
</div>
@endsection
