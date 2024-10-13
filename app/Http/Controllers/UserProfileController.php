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
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validación de la imagen
        ]);

        try {
            // Actualizar usuario autenticado
            $user = auth()->user();
            $user->name = $request->get('name');
            $user->surname = $request->get('surname');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->phone = $request->get('phone');

            // Subir y actualizar la imagen de perfil si se proporciona
            if ($request->hasFile('profile_photo')) {
                // Eliminar la imagen anterior si existe
                if ($user->profile_photo_path && file_exists(public_path('storage/' . $user->profile_photo_path))) {
                    unlink(public_path('storage/' . $user->profile_photo_path));
                }

                // Guardar la nueva imagen
                $path = $request->file('profile_photo')->store('profile_photos', 'public');
                $user->profile_photo_path = $path;
            }

            // Actualizar la contraseña si se proporciona
            if ($request->filled('password')) {
                $user->password = Hash::make($request->get('password'));
            }

            $user->save(); // Guardar cambios

            return back()->with('message', 'Perfil actualizado con éxito.');

        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al actualizar el perfil.');
        }
    }

}
