<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    // Mostrar panel de gestión de usuarios
    public function manageUsers()
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('admin.manage-users', compact('users'));
    }

    // Mostrar panel de gestión de productos
    public function manageProducts()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('admin.manage-products', compact('products'));
    }

    // Mostrar panel de gestión de pedidos
    public function manageOrders()
    {
        $orders = Order::all(); // Obtener todos los pedidos
        return view('admin.manage-orders', compact('orders'));
    }

    // Mostrar panel de reseñas
    public function manageReviews()
    {
        // Código para gestionar reseñas
    }

    // Mostrar panel de promociones y descuentos
    public function managePromotions()
    {
        // Código para gestionar promociones y descuentos
    }

    // Mostrar reportes
    public function reports()
    {
        // Código para generar y mostrar reportes
    }
}
