<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use App\Models\User;
use App\Models\Pedido;
use Exception;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{   
    public function processPayment(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'total' => 'required|numeric|min:0', // Asegúrate de que total es un número positivo
        ]);

        // Autenticación del usuario
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'No estás autenticado.'], 401);
        }

        // Establecer la clave de API de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Crear el PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->total * 100, // El monto en centavos
                'currency' => 'usd', // Cambia esto a tu moneda deseada
            ]);

            return view('pagos.checkout', [
                'clientSecret' => $paymentIntent->client_secret,
                'total' => $request->total,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            // Registro del error en el log de Laravel
            \Log::error('Error al procesar el pago: ' . $e->getMessage());

            // Mensaje más detallado para el cliente
            return response()->json(['error' => 'Error al procesar el pago: ' . $e->getMessage()], 500);
        }
    }

    public function guardarMetodoPago(Request $request)
    {
        // Validar los datos
        $request->validate([
            'pm_type' => 'required|string',
            'pm_last_four' => 'required|string',
            'payment_method_id' => 'required|string',
            'email' => 'required|email', // Añadimos la validación del correo
            'card_holder_name' => 'required|string', // Asegúrate de validar el nombre del titular de la tarjeta
        ]);

        // Autenticación del usuario (si ya está autenticado)
        $user = auth()->user();

        // Iniciar Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Crear o actualizar el cliente en Stripe
            if (!$user->stripe_id) {
                // Crear nuevo cliente en Stripe
                $customer = Customer::create([
                    'email' => $request->email ?? $user->email,
                    'name' => $request->card_holder_name,
                ]);
                $user->stripe_id = $customer->id;
            } else {
                // Actualizar cliente existente
                Customer::update($user->stripe_id, [
                    'email' => $request->email ?? $user->email,
                    'name' => $request->card_holder_name,
                ]);
            }

            // Actualizar método de pago del usuario en la base de datos
            $user->pm_type = $paymentMethod->card->brand; // Obtener el tipo de tarjeta
            $user->pm_last_four = $paymentMethod->card->last4; // Obtener los últimos cuatro dígitos
            $user->payment_method_id = $request->payment_method_id; // Guardar el ID del método de pago

            // Guardar los cambios en el modelo de usuario
            if (!$user->save()) {
                return response()->json(['error' => 'No se pudo guardar el método de pago'], 500);
            }

            return response()->json(['message' => 'Método de pago guardado con éxito!']);
        } catch (Exception $e) {
            // Manejo de errores
            return response()->json(['error' => 'Error al guardar el método de pago: ' . $e->getMessage()], 500);
        }
    }
}
