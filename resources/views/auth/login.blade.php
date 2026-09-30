@extends('layouts.app')
@section('titulo', 'Iniciar sesión')

@section('content')
<div class="card">
  <h2>Iniciar sesión</h2>

  <form method="POST" action="{{ route('login.post') }}">
    @csrf
    <div class="form-group">
      <label>Correo</label>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
      <label>Contraseña</label>
      <input type="password" name="password" required>
    </div>
    <button class="primary" type="submit">Entrar</button>
  </form>

  @error('email')
    <p class="error">{{ $message }}</p>
  @enderror

  <p style="margin-top:1rem">
    <a href="{{ route('registro') }}">¿No tienes cuenta? Regístrate</a>
  </p>
</div>
@endsection
