<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraWebController extends Controller
{
    public function store(Request $request)
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('tienda')->with('error', 'Tu carrito está vacío.');
        }

        $compra = DB::transaction(function () use ($carrito, $request) {
            $total = 0;
            $itemsData = [];

            foreach ($carrito as $productoId => $cantidad) {
                $producto = Producto::findOrFail($productoId);

                if ($producto->stock < $cantidad) {
                    abort(422, "Stock insuficiente para {$producto->nombre}");
                }

                $subtotal = $producto->precio * $cantidad;
                $total += $subtotal;

                $itemsData[] = [
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $producto->precio,
                ];

                $producto->decrement('stock', $cantidad);
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

        session()->forget('carrito');

        return redirect()->route('compras.factura', $compra->id)
            ->with('mensaje', 'Compra confirmada correctamente.');
    }

    public function index(Request $request)
    {
        $compras = $request->user()->compras()->latest()->get();

        return view('compras.index', compact('compras'));
    }

    public function factura(Request $request, $id)
    {
        $compra = Compra::with('items.producto', 'user')->findOrFail($id);

        if ($compra->user_id !== $request->user()->id && !$request->user()->isAdmin()) {
            abort(403);
        }

        return view('compras.factura', compact('compra'));
    }
}
