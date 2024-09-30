<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],  // Validación para el apellido
            'address' => ['required', 'string', 'max:255'],  // Validación para la dirección
            'phone' => ['required', 'string', 'max:15'],     // Validación para el teléfono
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear el usuario
        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],   // Guardar el apellido
            'address' => $input['address'],   // Guardar la dirección
            'phone' => $input['phone'],       // Guardar el teléfono
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('comerciante');
        return $user; 
    }

}
