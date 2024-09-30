@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Usuarios</h5>
                </div>
                <div class="px-3 pt-0 pb-2">
                    <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-success me-2" href="{{ route('roles.create') }}">Crear Rol</a>
                    <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-dark me-2" href="{{ route('permisos.create') }}">Crear Permiso</a>
                    <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-primary me-2" href="{{ route('rolesPermisos.show') }}">Mostrar Roles y Permisos</a>

                </div>
                <div class="card-body px-0 pt-2 pb-2">
                    @livewire('admin.users-index')
                </div>
            </div>
            
        </div>
    </div>
@endsection
