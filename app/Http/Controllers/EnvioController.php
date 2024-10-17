<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Envio;
use Illuminate\Support\Facades\Auth;

class EnvioController extends Controller
{
    public function mostrarEnvios()
    {
        $envios = Envio::with(['users', 'pedidos'])->get(); // Cambia 'user' por 'usuario'
        return view('envios.index', compact('envios'));
    }

    public function asignarEnvio(Request $request, $envioId)
    {
        $user = auth()->user();
        // Verificar si el usuario está autenticado
        if (!$user) {
            return response()->json(['error' => 'No estás autenticado.'], 401);
        }

        // Obtener el envío o mostrar un error si no existe
        $envio = Envio::findOrFail($envioId);

        // Verificar si ya hay un delivery asignado
        if (!is_null($envio->usuario_delivery_id)) {
            return redirect()->route('envios.index')->with('error', 'Este envío ya tiene un delivery asignado.');
        }

        // Asignar el envío al usuario autenticado
        $envio->usuario_delivery_id = $user->id;
        $envio->save();

        // Redirigir a la página de envíos con un mensaje de éxito
        return redirect()->route('envios.misEnvios')->with('message', 'Te has apuntado al envío con éxito.');
    }


    public function misEnvios()
    {
        $user = auth()->user();
        $envios = Envio::with('users','pedidos')
                   ->where('usuario_delivery_id', $user->id)
                   ->get();

        return view('envios.misEnvios', compact('envios'));
    }

    public function confirmarEnvio($id)
    {
        // Busca el envío por ID
        $envio = Envio::find($id);
        
        if (!$envio) {
            return redirect()->back()->with('error', 'Envío no encontrado.');
        }

        // Cambia el estado del envío a 'entregado'
        $envio->estado = 'entregado';
        $envio->save();

        // También cambia el estado del pedido relacionado a 'entregado'
        if ($envio->pedidos) {
            $pedido = $envio->pedidos; // Asegúrate de que hay una relación definida
            $pedido->estado = 'completado';
            $pedido->save();    
        }

        return redirect()->route('envios.misEnvios')->with('message', 'Envío confirmado y estado actualizado a entregado.');
    }

    public function destroy($id)
    {
        $envio = Envio::find($id);
    
        if (!$envio) {
            return redirect()->back()->with('error', 'Envío no encontrado.');
        }

        $envio->delete();

        return redirect()->back()->with('message', 'Envío eliminado con éxito.');
    }

}
