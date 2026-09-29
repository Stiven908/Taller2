@extends('layouts.tienda')
@section('titulo', 'Carrito')

@php $total = collect($items)->sum(fn ($i) => $i['precio'] * $i['cantidad']); @endphp

@section('contenido')
<h1 class="text-3xl font-extrabold tracking-tight">Tu carrito</h1>

@if (count($items) === 0)
    <p class="mt-6 text-slate-600">Tu carrito está vacío. <a href="{{ route('inicio') }}" class="font-semibold text-[#1B2A41] underline">Ver productos disponibles</a></p>
@else
<div class="mt-6 grid gap-8 lg:grid-cols-5">

    {{-- Ítems --}}
    <section class="lg:col-span-3" aria-labelledby="titulo-items">
        <h2 id="titulo-items" class="sr-only">Productos en el carrito</h2>
        <ul class="divide-y divide-slate-200 rounded-lg border border-slate-200 bg-white">
            @foreach ($items as $i)
                <li class="flex items-center gap-4 p-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-slate-100 text-2xl" aria-hidden="true">{{ $i['emoji'] }}</div>
                    <div class="flex-1">
                        <p class="font-semibold">{{ $i['nombre'] }}</p>
                        <p class="text-sm text-slate-500">${{ number_format($i['precio'], 0, ',', '.') }} c/u</p>
                        {{-- BACKEND: carrito.quitar elimina el ítem del carrito --}}
                        <form method="POST" action="{{ route('carrito.quitar', $i['id']) }}" class="mt-1">
                            @csrf @method('DELETE')
                            <button class="text-sm text-red-700 underline">Quitar</button>
                        </form>
                    </div>
                    <p class="text-sm">Cant. {{ $i['cantidad'] }}</p>
                    <p class="w-24 text-right font-semibold">${{ number_format($i['precio'] * $i['cantidad'], 0, ',', '.') }}</p>
                </li>
            @endforeach
        </ul>
        <p class="mt-4 flex justify-between text-lg font-extrabold">
            <span>Total a pagar</span><span>${{ number_format($total, 0, ',', '.') }}</span>
        </p>
    </section>

    {{-- Datos de la compra --}}
    <section class="lg:col-span-2" aria-labelledby="titulo-datos">
        <h2 id="titulo-datos" class="text-xl font-extrabold">Datos de la compra</h2>

        {{-- BACKEND: carrito.finalizar valida, guarda la compra, descuenta stock y devuelve el recibo --}}
        <form id="form-compra" method="POST" action="{{ route('carrito.finalizar') }}" class="mt-4 space-y-4 rounded-lg border border-slate-200 bg-white p-5">
            @csrf
            @foreach ([
                ['nombre', 'Nombre completo', 'text', 'name'],
                ['email', 'Correo electrónico', 'email', 'email'],
                ['telefono', 'Teléfono', 'tel', 'tel'],
                ['direccion', 'Dirección de entrega', 'text', 'street-address'],
                ['ciudad', 'Ciudad', 'text', 'address-level2'],
            ] as [$campo, $etiqueta, $tipo, $auto])
                <div>
                    <label for="{{ $campo }}" class="block text-sm font-semibold">{{ $etiqueta }}</label>
                    <input id="{{ $campo }}" name="{{ $campo }}" type="{{ $tipo }}" autocomplete="{{ $auto }}" required value="{{ old($campo) }}"
                           class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 focus:border-[#1B2A41] focus:outline-none focus:ring-2 focus:ring-[#F5B700]">
                    @error($campo)<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
                </div>
            @endforeach

            <div>
                <label for="pago" class="block text-sm font-semibold">Método de pago</label>
                <select id="pago" name="pago" required class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#F5B700]">
                    <option>Contra entrega</option>
                    <option>Transferencia bancaria</option>
                    <option>Tarjeta</option>
                </select>
            </div>

            <button type="submit" class="w-full rounded-md bg-[#F5B700] px-4 py-2.5 font-semibold text-[#1B2A41] hover:brightness-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1B2A41]">
                Realizar compra
            </button>
        </form>
    </section>
</div>

{{-- Recibo (ventana emergente) --}}
<dialog id="recibo" class="w-[min(92vw,28rem)] rounded-lg p-0 backdrop:bg-black/50">
    <div class="p-6">
        <h2 class="text-2xl font-extrabold">Compra realizada</h2>
        <p class="text-sm text-slate-600">Guarda este recibo como comprobante.</p>

        <div class="mt-4 rounded-md bg-slate-50 p-4 text-sm">
            <p><strong>Recibo N.º</strong> <span id="r-numero"></span></p>
            <p><strong>Fecha:</strong> <span id="r-fecha"></span></p>
            <p><strong>Cliente:</strong> <span id="r-cliente"></span></p>
            <p><strong>Entrega:</strong> <span id="r-entrega"></span></p>
            <p><strong>Pago:</strong> <span id="r-pago"></span></p>

            <ul id="r-items" class="mt-3 divide-y divide-slate-200"></ul>
            <p class="mt-3 flex justify-between text-base font-extrabold"><span>Total</span><span id="r-total"></span></p>
        </div>

        <div class="mt-5 flex gap-2">
            <button type="button" onclick="window.print()" class="flex-1 rounded-md border border-[#1B2A41] px-3 py-2 font-semibold text-[#1B2A41] hover:bg-slate-100">Imprimir</button>
            <a href="{{ route('inicio') }}" class="flex-1 rounded-md bg-[#F5B700] px-3 py-2 text-center font-semibold text-[#1B2A41] hover:brightness-95">Seguir comprando</a>
        </div>
    </div>
</dialog>
@endif
@endsection

@push('scripts')
<script>
    /*
     * MAQUETA: al enviar el formulario se arma el recibo con los datos del carrito.
     * BACKEND: cuando exista la lógica real, el controlador debe guardar la compra y devolver
     * el recibo (número, fecha, ítems, total). Entonces se elimina el preventDefault y se
     * abre este <dialog> con los datos que devuelva el servidor (p. ej. con session flash o fetch).
     */
    const items = @json($items);
    const form = document.getElementById('form-compra');
    const dialogo = document.getElementById('recibo');
    const peso = n => '$' + n.toLocaleString('es-CO');

    form?.addEventListener('submit', e => {
        e.preventDefault();
        if (!form.reportValidity()) return;

        const d = Object.fromEntries(new FormData(form));
        const total = items.reduce((s, i) => s + i.precio * i.cantidad, 0);

        document.getElementById('r-numero').textContent = String(Math.floor(Math.random() * 9000) + 1000);
        document.getElementById('r-fecha').textContent = new Date().toLocaleString('es-CO');
        document.getElementById('r-cliente').textContent = `${d.nombre} (${d.email})`;
        document.getElementById('r-entrega').textContent = `${d.direccion}, ${d.ciudad}`;
        document.getElementById('r-pago').textContent = d.pago;
        document.getElementById('r-total').textContent = peso(total);
        document.getElementById('r-items').innerHTML = items.map(i =>
            `<li class="flex justify-between py-1.5"><span>${i.cantidad} × ${i.nombre}</span><span>${peso(i.precio * i.cantidad)}</span></li>`
        ).join('');

        dialogo.showModal();
    });
</script>
@endpush
