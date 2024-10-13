<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseña;
use App\Models\Producto;

class ReseñaController extends Controller
{   
    public function index($producto_id)
    {
        $reseñas = Reseña::where('producto_id', $producto_id)->get();
        $product = Producto::find($producto_id); 
        return view('resenias.index', compact('reseñas','product'));
    }


    public function create($producto_id)
    {
        $product = Producto::findOrFail($producto_id);
        return view('resenias.create', compact('product'));
    }

    public function store(Request $request, $producto_id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255',
        ]);

        Reseña::create([
            'producto_id' => $producto_id,
            'user_id' => auth()->id(),
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('catalogo.index')->with('message', 'Reseña guardada exitosamente');
    }

    public function destroy($id)
    {
        // Buscar la reseña por su ID
        $reseña = Reseña::findOrFail($id);
        $product_id = $reseña->product_idç;
        $reseña->delete();

        return back()->with('success', 'Reseña eliminada con éxito.');
    }

}
