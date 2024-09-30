<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recuperar todos los permisos existentes, si deseas mostrarlos
        $permissions = Permission::all();
        return view('permisos.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar que se haya ingresado al menos un permiso
        $request->validate([
            'permissions' => 'required|array',  // Aseguramos que se seleccionen permisos y que sean un array
            'permissions.*' => 'required|string|unique:permissions,name'  // Cada permiso debe ser único y no debe estar vacío
        ]);
        // Crear cada permiso
        foreach ($request->permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Redirigir a la vista de creación con mensaje de éxito
        return redirect()->route('permisos.create')
            ->with('message', 'Permiso(s) creado(s) exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
