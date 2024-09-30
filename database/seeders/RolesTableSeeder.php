<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Limpia cache de roles y permisos para evitar problemas de duplicados
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissionsAdmin = [
            // Permisos para el administrador
            'ver inicio',
            'gestionar usuarios',
            'gestionar permisos',
            'gestionar productos',
            'gestionar pedidos',
            'ver reportes',
        ];

        $permissionsComerciante = [ 
            // Permisos para el comerciante
            'ver mis productos',
            'gestionar reseñas de productos',
            'gestionar promociones',
            'ver pedidos',
            'ver carrito',
        ];

        $permissionsDelivery  = [
            // Permisos para el delivery
            'ver pedidos disponibles',
            'gestionar mis entregas',
        ];

        // Crear permisos
        foreach ($permissionsAdmin as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
        foreach ($permissionsComerciante as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
        foreach ($permissionsDelivery as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Crear roles
        $administrador = Role::create(['name' => 'administrador']);
        $comerciante = Role::create(['name' => 'comerciante']);
        $delivery = Role::create(['name' => 'delivery']);

        // Asignar todos los permisos al rol de administrador
        $administrador->givePermissionTo($permissionsAdmin);
        $comerciante->givePermissionTo($permissionsComerciante);
        $delivery->givePermissionTo($permissionsDelivery);

        // Crear un usuario con los atributos especificados
        $user = User::create([
            'name' => 'Joaquin', // Reemplaza 'Nombre' por el nombre deseado
            'surname' => 'Kapa', // Reemplaza 'Apellido' por el apellido deseado
            'phone' => '78875594', // Reemplaza '123456789' por el número de teléfono deseado
            'address' => 'Alto Tejar Chualluma', // Reemplaza 'Dirección' por la dirección deseada
            'email' => 'jgriezmann77@gmail.com', // Reemplaza 'admin@example.com' por el email deseado
            'password' => Hash::make('12345678'), // Reemplaza 'password' por la contraseña deseada
            'profile_photo_path' => 'images/profile_photos/joaquin.jpg',
        ]);
        
        // Asignar roles al usuario creado
        if ($user) {
            $user->assignRole([$administrador, $comerciante, $delivery]);
        } else {
            $this->command->info('No se pudo crear el usuario.');
        }
    }
}
