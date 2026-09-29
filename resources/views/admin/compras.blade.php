@extends('layouts.tienda')
@section('titulo', 'Compras de clientes')

@php
    $estados = [
        'Pagada'    => 'bg-emerald-100 text-emerald-900',
        'Pendiente' => 'bg-amber-100 text-amber-900',
        'Cancelada' => 'bg-red-100 text-red-900',
    ];
    $ingresos = collect($compras)->where('estado', 'Pagada')->sum('total');
@endphp

@section('contenido')
<h1 class="text-3xl font-extrabold tracking-tight">Compras de clientes</h1>
<p class="mt-1 text-slate-600">Todas las compras registradas en la tienda, de la más reciente a la más antigua.</p>

<dl class="mt-6 grid gap-4 sm:grid-cols-3">
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <dt class="text-sm text-slate-500">Compras registradas</dt>
        <dd class="text-2xl font-extrabold">{{ count($compras) }}</dd>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <dt class="text-sm text-slate-500">Ingresos por compras pagadas</dt>
        <dd class="text-2xl font-extrabold">${{ number_format($ingresos, 0, ',', '.') }}</dd>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4">
        <dt class="text-sm text-slate-500">Pendientes de pago</dt>
        <dd class="text-2xl font-extrabold">{{ collect($compras)->where('estado', 'Pendiente')->count() }}</dd>
    </div>
</dl>

<div class="mt-6 flex flex-col gap-3 sm:flex-row">
    <div>
        <label for="filtro-cliente" class="sr-only">Buscar por cliente</label>
        <input id="filtro-cliente" type="search" placeholder="Buscar por cliente"
               class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 sm:w-64 focus:outline-none focus:ring-2 focus:ring-[#F5B700]">
    </div>
    <div>
        <label for="filtro-estado" class="sr-only">Filtrar por estado</label>
        <select id="filtro-estado" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 sm:w-48 focus:outline-none focus:ring-2 focus:ring-[#F5B700]">
            <option value="">Todos los estados</option>
            @foreach (array_keys($estados) as $e)<option>{{ $e }}</option>@endforeach
        </select>
    </div>
</div>

{{-- BACKEND: reemplazar $compras por la consulta real (compra + cliente + detalle de productos) --}}
<div class="mt-4 overflow-x-auto rounded-lg border border-slate-200 bg-white">
    <table class="w-full min-w-[720px] text-left text-sm">
        <thead class="bg-slate-100 text-slate-700">
            <tr>
                <th class="px-4 py-3 font-semibold">N.º</th>
                <th class="px-4 py-3 font-semibold">Fecha</th>
                <th class="px-4 py-3 font-semibold">Cliente</th>
                <th class="px-4 py-3 font-semibold">Productos</th>
                <th class="px-4 py-3 text-right font-semibold">Total</th>
                <th class="px-4 py-3 font-semibold">Estado</th>
            </tr>
        </thead>
        <tbody id="filas" class="divide-y divide-slate-200">
            @foreach ($compras as $c)
                <tr data-cliente="{{ Str::lower($c['cliente']) }}" data-estado="{{ $c['estado'] }}">
                    <td class="px-4 py-3 font-semibold">#{{ str_pad($c['id'], 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-4 py-3">{{ $c['fecha'] }}</td>
                    <td class="px-4 py-3">
                        {{ $c['cliente'] }}
                        <span class="block text-slate-500">{{ $c['email'] }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $c['productos'] }}</td>
                    <td class="px-4 py-3 text-right font-semibold">${{ number_format($c['total'], 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $estados[$c['estado']] }}">{{ $c['estado'] }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p id="sin-resultados" class="hidden px-4 py-8 text-center text-slate-600">Ninguna compra coincide con el filtro.</p>
</div>
@endsection

@push('scripts')
<script>
    const cliente = document.getElementById('filtro-cliente');
    const estado = document.getElementById('filtro-estado');
    const filas = [...document.querySelectorAll('#filas tr')];

    function filtrar() {
        const q = cliente.value.trim().toLowerCase();
        let visibles = 0;
        filas.forEach(f => {
            const ok = f.dataset.cliente.includes(q) && (!estado.value || f.dataset.estado === estado.value);
            f.classList.toggle('hidden', !ok);
            if (ok) visibles++;
        });
        document.getElementById('sin-resultados').classList.toggle('hidden', visibles > 0);
    }
    cliente.addEventListener('input', filtrar);
    estado.addEventListener('change', filtrar);
</script>
@endpush
