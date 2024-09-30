<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Mostrar la lista de roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function show()
    {
        $roles = Role::with('permissions')->get(); // Obtener roles con sus permisos
        return view('roles.rolesPermisos', compact('roles')); // Retornar la vista con los roles
    }

    // Mostrar el formulario para crear un nuevo rol
    public function create()
    {
        // Recuperar todos los permisos existentes
        $permissions = Permission::all();
        $userPermissions = [];
        return view('roles.create', compact('permissions', 'userPermissions'));
    }

    // Almacenar el nuevo rol en la base de datos
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|unique:roles,name', // Aseguramos que el nombre del rol sea único
            'permissions' => 'required|array',     // Aseguramos que se seleccionen permisos y que sean un array
            //'permissions.*' => 'string|exists:permissions,name' // Cada permiso debe existir
        ]);

        // Crear el rol
        $role = Role::create(['name' => $request->name]);

        // Sincronizar permisos (asignar permisos al rol)
        // Obtener los IDs de los permisos que ya existen
        $permissions = Permission::whereIn('name', $request->permissions)->pluck('id')->toArray();
        $role->syncPermissions($permissions);

        $userPermissions = $role->permissions()->pluck('name')->toArray();
         return redirect()->route('roles.create')
        ->with('message', 'Rol creado exitosamente')
        ->with('userPermissions', $userPermissions);  
    }


    // Mostrar el formulario para editar un rol
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    // Actualizar el rol y sus permisos
    public function update(Request $request, Role $role)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required'
        ]);

        // Actualizar el nombre del rol
        $role->update(['name' => $request->name]);

        // Sincronizar los permisos
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
    }

    // Eliminar un rol
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente');
    }

    
}

