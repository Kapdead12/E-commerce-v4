<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255|min:2',
            'surname' => 'required|max:255|min:2', // Agregado
            'phone' => 'required|max:15', // Agregado
            'address' => 'required|max:255', // Agregado
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'terms' => 'required'
        ]);

        // Crea el usuario con los atributos validados
        $user = User::create([
            'name' => $attributes['name'],
            'surname' => $attributes['surname'],
            'phone' => $attributes['phone'],
            'address' => $attributes['address'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']), // Asegúrate de encriptar la contraseña
        ]);

        // Asigna el rol de comerciante al usuario creado
        $user->assignRole('comerciante');

        // Inicia sesión automáticamente al registrar el usuario
        auth()->login($user);

        return redirect('/dashboard');
    }
}
