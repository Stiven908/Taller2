@extends('layaouts.tienda')

@section('title', 'Iniciar sesión')

@section('content')

<div class="login-container">

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-sm-10 col-md-7 col-lg-5">

                <div class="card border-0 shadow-lg">

                    <div class="card-body p-5">

                        {{-- LOGO --}}
                        <div class="text-center mb-4">

                            <div class="login-icon">
                                <i class="bi bi-shop"></i>
                            </div>

                            <h2 class="fw-bold mt-3">
                                Bienvenido
                            </h2>

                            <p class="text-muted">
                                Inicia sesión para continuar
                            </p>

                        </div>


                        {{-- MENSAJE DE ERROR --}}
                        @if(session('error'))

                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                {{ session('error') }}
                            </div>

                        @endif


                        {{-- FORMULARIO --}}
                        <form action="#" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Correo electrónico
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="ejemplo@correo.com"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Contraseña
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Ingrese su contraseña"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword()"
                                    >
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>

                                </div>

                            </div>


                            <div class="d-flex justify-content-between mb-4">

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="remember"
                                        id="remember"
                                    >

                                    <label
                                        class="form-check-label"
                                        for="remember"
                                    >
                                        Recordarme
                                    </label>

                                </div>

                                <a href="#" class="text-decoration-none">
                                    ¿Olvidaste tu contraseña?
                                </a>

                            </div>


                            <button
                                type="submit"
                                class="btn btn-primary w-100 py-2 fw-semibold"
                            >
                                <i class="bi bi-box-arrow-in-right"></i>
                                Iniciar sesión
                            </button>

                        </form>


                        <div class="text-center mt-4">

                            <p class="text-muted mb-0">
                                ¿No tienes una cuenta?
                            </p>

                            <a href="#" class="fw-semibold text-decoration-none">
                                Crear una cuenta
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

function togglePassword() {

    const password = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');

    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');

    }

}

</script>

@endpush