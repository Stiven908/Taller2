<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // Historial de compras del usuario autenticado
    public function index(Request $request)
    {
        return $request->user()->compras()->with('items.producto')->latest()->get();
    }

    // Crear una compra con varios productos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.producto_id' => 'required|exists:productos,id',
            'items.*.cantidad' => 'required|integer|min:1',
        ]);

        $compra = DB::transaction(function () use ($validated, $request) {
            $total = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $producto = Producto::findOrFail($item['producto_id']);

                if ($producto->stock < $item['cantidad']) {
                    abort(422, "Stock insuficiente para {$producto->nombre}");
                }

                $subtotal = $producto->precio * $item['cantidad'];
                $total += $subtotal;

                $itemsData[] = [
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio,
                ];

                $producto->decrement('stock', $item['cantidad']);
            }

            $compra = Compra::create([
                'user_id' => $request->user()->id,
                'total' => $total,
            ]);

            foreach ($itemsData as $data) {
                $compra->items()->create($data);
            }

            return $compra;
        });

        return response()->json(
            $compra->load('items.producto'),
            201
        );
    }

    // Factura de una compra específica (solo si es del usuario dueño)
    public function factura(Request $request, $id)
    {
        $compra = Compra::with('items.producto', 'user')->find($id);

        if (!$compra) {
            return response()->json(['message' => 'Compra no encontrada'], 404);
        }

        if ($compra->user_id !== $request->user()->id && !$request->user()->isAdmin()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json([
            'numero_factura' => str_pad($compra->id, 6, '0', STR_PAD_LEFT),
            'fecha' => $compra->created_at->format('d/m/Y H:i'),
            'cliente' => $compra->user->name,
            'items' => $compra->items->map(function ($item) {
                return [
                    'producto' => $item->producto->nombre,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $item->precio_unitario,
                    'subtotal' => $item->cantidad * $item->precio_unitario,
                ];
            }),
            'total' => $compra->total,
        ]);
    }
}
