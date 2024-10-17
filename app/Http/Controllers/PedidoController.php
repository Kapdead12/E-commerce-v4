<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Envio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PedidoController extends Controller
{
    public function mostrarPedidos()
    {
        $pedidos = Pedido::with(['user', 'productos', 'envio'])->get(); // Puedes usar relaciones si tienes un modelo de usuario
        //return response()->json($pedidos);
        return view('pedidos.index', compact('pedidos'));
    }

    public function crearPedido_Envio(Request $request)
    {
        
            // Validación de los datos
            $request->validate([
                'total' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'direccion' => 'required|string',
            ]);

             $user = auth()->user();
             
            if (!$user) {
                return response()->json(['error' => 'No estás autenticado.'], 401);
            }
            // Crear el pedido
            $pedido = Pedido::create([
                'user_id' => $user->id,
                'total' => $request->total,
            ]);

            $envio = Envio::create([
                'pedido_id' => $pedido->id,
                //'usuario_delivery_id' => null,
                'direccion' => $request->direccion,
            ]);

            $productos = session()->get('carrito', []);

            if (empty($productos)) {
                return response()->json(['error' => 'No hay productos en el carrito'], 400);
            }
            
            foreach ($productos as $producto) {
                $dummyProduct = [
                    'producto_id' => $producto['product_id'], // Asegúrate de que este ID exista en la tabla productos
                    'cantidad' => $producto['cantidad'],
                ];
                $pedido->productos()->attach($dummyProduct['producto_id'], ['cantidad' => $dummyProduct['cantidad']]);
            }

            // Limpiar el carrito en la sesión después de crear el pedido
            session()->forget('carrito');

            return redirect()->route('pedidos.index')->with('succes', 'Pedido creado con éxito.');
        
    }

    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        if (!$pedido) {
            return redirect()->back()->with('error', 'Pedido no encontrado.');
        }
        $pedido->delete();

        return redirect()->back()->with('message', 'Pedido eliminado con éxito.');
    }

}
