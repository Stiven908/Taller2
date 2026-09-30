<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('nombre')->get();

        return view('tienda.index', compact('productos'));
    }

    public function agregarAlCarrito(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);

        $validated = $request->validate([
            'cantidad' => 'required|integer|min:1|max:' . $producto->stock,
        ]);

        $carrito = session('carrito', []);
        $carrito[$productoId] = ($carrito[$productoId] ?? 0) + $validated['cantidad'];
        session(['carrito' => $carrito]);

        return back()->with('mensaje', "{$producto->nombre} agregado al carrito.");
    }

    public function quitarDelCarrito($productoId)
    {
        $carrito = session('carrito', []);
        unset($carrito[$productoId]);
        session(['carrito' => $carrito]);

        return redirect()->route('carrito');
    }

    public function verCarrito()
    {
        $carrito = session('carrito', []);
        $items = [];
        $total = 0;

        foreach ($carrito as $productoId => $cantidad) {
            $producto = Producto::find($productoId);
            if (!$producto) {
                continue;
            }
            $subtotal = $producto->precio * $cantidad;
            $total += $subtotal;
            $items[] = compact('producto', 'cantidad', 'subtotal');
        }

        return view('carrito.index', compact('items', 'total'));
    }
}
