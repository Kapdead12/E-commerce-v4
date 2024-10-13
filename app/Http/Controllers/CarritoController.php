<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\Session;
use Auth;

class CarritoController extends Controller
{   
    public function clearSession()
    {
        // Vaciar toda la sesión
        Session::flush();

        return response()->json(['success' => 'Sesión vaciada.']);
    }

    public function index()
    {
        $carritos = Session::get('carrito', []);
        return view('carrito.index', compact('carritos'));
    }

    public function addCarrito(Request $request, $productId)
    {
        // Buscar el producto por ID
        $product = Producto::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }

        // Obtener la cantidad de la solicitud (por defecto 1)
        $cantidad = $request->input('cantidad', 1);
        
        // Verificar que la cantidad no exceda el stock disponible
        if ($cantidad > $product->stock) {
            return response()->json(['error' => 'Cantidad excede el stock disponible.'], 400);
        }

        // Actualizar el stock del producto
        $product->stock -= $cantidad;
        $product->save();

        // Obtener el carrito de la sesión
        $cartCarrito = Session::get('carrito', []);
        
        // Verificar si el producto ya está en el carrito
        if (isset($cartCarrito[$productId])) {
            // Incrementar la cantidad
            $cartCarrito[$productId]['cantidad'] += $cantidad;
        } else {
            // Agregar nuevo producto al carrito
            $cartCarrito[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'cantidad' => $cantidad,
                'product_id' => $productId
            ];
        }

        // Guardar el carrito actualizado en la sesión
        Session::put('carrito', $cartCarrito);

        return response()->json([
            'success' => 'Producto agregado al carrito.',
            'nuevoStock' => $product->stock // Enviar el nuevo stock actualizado
        ]);
    }


    public function remove(Request $request, $productId)
    {
        $quantityToRemove = $request->input('cantidad', 1); // Cantidad a eliminar, predeterminada 1
        $cartCarrito = Session::get('carrito', []);

        if (isset($cartCarrito[$productId])) {
            $product = Producto::find($productId);

            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado.'], 404);
            }

            // Verificar si la cantidad a eliminar es menor que la cantidad actual
            if ($cartCarrito[$productId]['cantidad'] > $quantityToRemove) {
                // Reducir la cantidad en la cantidad solicitada
                $cartCarrito[$productId]['cantidad'] -= $quantityToRemove;

                // Aumentar el stock del producto
                $product->stock += $quantityToRemove;
                $product->save();

            } else {
                // Si la cantidad a eliminar es igual o mayor, eliminar el producto del carrito
                // y devolver toda la cantidad al stock
                $product->stock += $cartCarrito[$productId]['cantidad'];
                $product->save();

                unset($cartCarrito[$productId]);
            }

            // Guardar el carrito actualizado en la sesión
            Session::put('carrito', $cartCarrito);

            return response()->json(['success' => 'Cantidad eliminada del carrito y stock actualizado.']);
        }

        return response()->json(['error' => 'Producto no encontrado en el carrito.'], 404);
    }


}
