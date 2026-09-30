<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class AdminWebController extends Controller
{
    public function historial(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            abort(403);
        }

        $compras = Compra::with('items.producto', 'user')->latest()->get();

        return view('admin.historial', compact('compras'));
    }
}
