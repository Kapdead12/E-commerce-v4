<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComercianteController extends Controller
{
    // Mostrar los productos del comerciante autenticado
    public function myProducts()
    {
        $user = Auth::user();
        $products = Product::where('user_id', $user->id)->get(); // Obtener solo los productos del comerciante autenticado
        return view('comerciante.my-products', compact('products'));
    }

    // Mostrar los pedidos que ha recibido el comerciante
    public function myOrders()
    {
        $user = Auth::user();
        $orders = Order::where('seller_id', $user->id)->get(); // Obtener los pedidos que están dirigidos a este comerciante
        return view('comerciante.my-orders', compact('orders'));
    }

    // Gestionar reseñas de productos del comerciante
    public function manageProductReviews()
    {
        // Código para gestionar las reseñas de sus productos
    }

    // Gestionar promociones
    public function managePromotions()
    {
        // Código para gestionar las promociones de sus productos
    }

    // Ver el carrito de compras como comprador (si el comerciante también compra)
    public function viewCart()
    {
        // Código para gestionar el carrito de compras
    }
}
