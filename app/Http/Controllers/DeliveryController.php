<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    // Mostrar los pedidos disponibles para entrega
    public function availableOrders()
    {
        $orders = Order::where('status', 'ready_for_delivery')->get(); // Obtener los pedidos que están listos para ser entregados
        return view('delivery.available-orders', compact('orders'));
    }

    // Mostrar las entregas del repartidor autenticado
    public function myDeliveries()
    {
        $user = Auth::user();
        $deliveries = Order::where('delivery_person_id', $user->id)->get(); // Obtener los pedidos asignados a este repartidor
        return view('delivery.my-deliveries', compact('deliveries'));
    }

    // Actualizar el estado de una entrega (por ejemplo, marcar como completada)
    public function updateDeliveryStatus($orderId, Request $request)
    {
        $order = Order::find($orderId);
        $order->status = $request->status; // Cambiar el estado (completado, en progreso, etc.)
        $order->save();

        return redirect()->back()->with('status', 'Estado de la entrega actualizado');
    }
}
