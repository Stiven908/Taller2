<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoWebController extends Controller
{
    public function index(Request $request)
    {
        

        $productos = Producto::orderBy('nombre')->get();

        return view('admin.productos', compact('productos'));
    }

    public function create(Request $request)
    {
        

        return view('admin.productos_crear');
    }

    public function store(Request $request)
    {
        

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'nullable|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Producto::create($validated);

        return redirect()->route('admin.productos')->with('mensaje', 'Producto creado correctamente.');
    }
}
