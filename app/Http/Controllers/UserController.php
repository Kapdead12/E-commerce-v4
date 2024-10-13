<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); 
        return view('pages.user-management', compact('users')); 
    }

    public function permisos($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = Permission::all();
        $userPermissions = $user->permissions()->pluck('name')->toArray();
        return view('admin.users.permisos', compact('user', 'permissions', 'userPermissions'));
    }


    public function updatePermissions(Request $request, $userId)
    {
        // Validar los permisos que se están pasando
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);
        //dd($request['permissions']);
        // Obtener el usuario por su ID
        $user = User::findOrFail($userId);
        $user->syncPermissions($request['permissions']);
        // Verificar permisos actuales
        $userPermissions = $user->permissions()->pluck('name')->toArray();
        return redirect()->route('users.permisos', $user->id)->with('message', 'Permisos actualizados correctamente.');
    }


    public function store(Request $request)
    {
        
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Obtener todos los roles disponibles
        $userRoles = $user->roles->pluck('name')->toArray(); // Obtener los roles actuales del usuario

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    // Actualizar roles del usuario
    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'string|distinct',
        ]);

        // Buscar el usuario
        $user = User::findOrFail($id);

        // Sincronizar los roles del usuario
        $user->syncRoles($request->roles);

        // Obtener todos los permisos de los roles asignados al usuario
        $newRolesPermissions = $user->roles->flatMap(function($role) {
            return $role->permissions->pluck('name')->toArray();
        })->toArray();

        // Sincronizar los permisos del usuario según los roles
        $user->syncPermissions($newRolesPermissions);

        return redirect()->route('users.edit', $user->id)->with('message', 'Roles actualizados exitosamente.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        $user->delete();
        return redirect()->back()->with('message', 'Usuario eliminado con éxito');
    }

}
