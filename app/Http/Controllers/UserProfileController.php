<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash; 

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'surname' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'address' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:15'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        try {
            // Actualizar usuario autenticado
            $user = auth()->user();
            $user->name = $request->get('name');
            $user->surname = $request->get('surname');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->phone = $request->get('phone');
    
            // Actualizar la contraseña si se proporciona
            if ($request->filled('password')) {
                $user->password = Hash::make($request->get('password'));
            }
    
            $user->save(); // Guardar cambios
    
            // Redirigir con mensaje de éxito
            //return redirect()->route('profile.update')->with('message', 'Perfil actualizado.');
            return back()->with('message', 'Perfil actualizado.');
        
        } catch (\Exception $e) {
            // Retornar un mensaje de error si algo falla
            return back()->with('error', 'Hubo un error al actualizar el perfil.');
        }//return back()->with('success', 'Profile successfully updated');
    }

}
