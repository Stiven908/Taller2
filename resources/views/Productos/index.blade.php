@extends('layouts.app')

@section('title', 'Inicio - Mi Tienda')

@section('content')

{{-- HERO --}}

<section class="store-hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <h1 class="display-5 fw-bold">
                    Encuentra todo lo que necesitas
                </h1>

                <p class="lead">
                    Compra ropa, alimentos, artículos para el hogar
                    y mucho más.
                </p>

                <a href="#productos" class="btn btn-light btn-lg">
                    Ver productos
                    <i class="bi bi-arrow-down"></i>
                </a>

            </div>

        </div>

    </div>

</section>


{{-- PRODUCTOS --}}

<section class="container py-5" id="productos">

    <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-md-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Productos disponibles
            </h2>

            <p class="text-muted mb-0">
                Selecciona los productos que deseas comprar.
            </p>

        </div>

    </div>


    {{-- BÚSQUEDA Y FILTROS --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Buscar producto..."
                        >

                    </div>

                </div>


                <div class="col-md-3">

                    <select class="form-select">

                        <option selected>
                            Todas las categorías
                        </option>

                        <option>Ropa</option>
                        <option>Alimentos</option>
                        <option>Hogar</option>
                        <option>Tecnología</option>

                    </select>

                </div>


                <div class="col-md-3">

                    <select class="form-select">

                        <option selected>
                            Ordenar por
                        </option>

                        <option>Precio menor</option>
                        <option>Precio mayor</option>
                        <option>Nombre</option>

                    </select>

                </div>

            </div>

        </div>

    </div>


    {{-- GRID DE PRODUCTOS --}}

    <div class="row g-4">


        {{-- PRODUCTO 1 --}}

        <div class="col-sm-6 col-lg-4 col-xl-3">

            <div class="card product-card border-0 shadow-sm h-100">

                <div class="product-image">

                    <img
                        src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top"
                        alt="Camiseta básica"
                    >

                    <span class="badge bg-success stock-badge">
                        En stock
                    </span>

                </div>


                <div class="card-body d-flex flex-column">

                    <small class="text-muted">
                        Ropa
                    </small>

                    <h5 class="card-title fw-bold mt-1">
                        Camiseta básica
                    </h5>

                    <p class="text-muted small">
                        Camiseta de algodón disponible en diferentes tallas.
                    </p>

                    <div class="mt-auto">

                        <h4 class="fw-bold text-primary">
                            $45.000
                        </h4>

                        <small class="text-muted">
                            15 unidades disponibles
                        </small>

                        <div class="d-grid gap-2 mt-3">

                            <button class="btn btn-primary">
                                <i class="bi bi-bag-check"></i>
                                Comprar
                            </button>

                            <button class="btn btn-outline-primary">
                                <i class="bi bi-cart-plus"></i>
                                Agregar al carrito
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUCTO 2 --}}

        <div class="col-sm-6 col-lg-4 col-xl-3">

            <div class="card product-card border-0 shadow-sm h-100">

                <div class="product-image">

                    <img
                        src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top"
                        alt="Alimentos"
                    >

                    <span class="badge bg-success stock-badge">
                        En stock
                    </span>

                </div>


                <div class="card-body d-flex flex-column">

                    <small class="text-muted">
                        Alimentos
                    </small>

                    <h5 class="card-title fw-bold mt-1">
                        Canasta de alimentos
                    </h5>

                    <p class="text-muted small">
                        Selección de productos básicos para el hogar.
                    </p>

                    <div class="mt-auto">

                        <h4 class="fw-bold text-primary">
                            $75.000
                        </h4>

                        <small class="text-muted">
                            8 unidades disponibles
                        </small>

                        <div class="d-grid gap-2 mt-3">

                            <button class="btn btn-primary">
                                <i class="bi bi-bag-check"></i>
                                Comprar
                            </button>

                            <button class="btn btn-outline-primary">
                                <i class="bi bi-cart-plus"></i>
                                Agregar al carrito
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUCTO 3 --}}

        <div class="col-sm-6 col-lg-4 col-xl-3">

            <div class="card product-card border-0 shadow-sm h-100">

                <div class="product-image">

                    <img
                        src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top"
                        alt="Sofá"
                    >

                    <span class="badge bg-warning text-dark stock-badge">
                        Pocas unidades
                    </span>

                </div>


                <div class="card-body d-flex flex-column">

                    <small class="text-muted">
                        Hogar
                    </small>

                    <h5 class="card-title fw-bold mt-1">
                        Sofá moderno
                    </h5>

                    <p class="text-muted small">
                        Sofá moderno y cómodo para sala.
                    </p>

                    <div class="mt-auto">

                        <h4 class="fw-bold text-primary">
                            $850.000
                        </h4>

                        <small class="text-muted">
                            3 unidades disponibles
                        </small>

                        <div class="d-grid gap-2 mt-3">

                            <button class="btn btn-primary">
                                <i class="bi bi-bag-check"></i>
                                Comprar
                            </button>

                            <button class="btn btn-outline-primary">
                                <i class="bi bi-cart-plus"></i>
                                Agregar al carrito
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRODUCTO 4 --}}

        <div class="col-sm-6 col-lg-4 col-xl-3">

            <div class="card product-card border-0 shadow-sm h-100">

                <div class="product-image">

                    <img
                        src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80"
                        class="card-img-top"
                        alt="Reloj"
                    >

                    <span class="badge bg-success stock-badge">
                        En stock
                    </span>

                </div>


                <div class="card-body d-flex flex-column">

                    <small class="text-muted">
                        Accesorios
                    </small>

                    <h5 class="card-title fw-bold mt-1">
                        Reloj clásico
                    </h5>

                    <p class="text-muted small">
                        Reloj de diseño clásico para uso diario.
                    </p>

                    <div class="mt-auto">

                        <h4 class="fw-bold text-primary">
                            $120.000
                        </h4>

                        <small class="text-muted">
                            12 unidades disponibles
                        </small>

                        <div class="d-grid gap-2 mt-3">

                            <button class="btn btn-primary">
                                <i class="bi bi-bag-check"></i>
                                Comprar
                            </button>

                            <button class="btn btn-outline-primary">
                                <i class="bi bi-cart-plus"></i>
                                Agregar al carrito
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection