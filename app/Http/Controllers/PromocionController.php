<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Promocion;

class PromocionController extends Controller
{   
    public function index()
    {   
        $promociones = Promocion::all(); 
        return view('promocion.index', compact('promociones'));
    }
    
    public function create()
    {   
        $products = Producto::all(); 
        return view('promocion.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'name' => 'required|string|max:255',
            'desc_porcentaje' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Promocion::create($request->all());
        return redirect()->route('productos.index')->with('message', 'Promoción creada con éxito.');
    }
}
