<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function historialCompras(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return Compra::with('items.producto', 'user')->latest()->get();
    }
}
