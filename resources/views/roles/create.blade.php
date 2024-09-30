@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Role Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="px-5 py-4 bg-white border-0 shadow-lg sm:rounded-3xl">
                        <h1 class="text-2xl font-bold mb-4">Crear Nuevo Rol</h1>

                        @if (session('message'))
                            <div class="alert alert-success text-white" role="alert" style="background-color: #28a745; border-color: #28a745;">
                                <strong>{{ session('message') }}</strong>
                            </div>
                        @endif

                        <form action="{{ route('roles.store') }}" method="POST" novalidate>
                            @csrf

                            <!-- Input para el nombre del rol -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Rol</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del rol" required>
                            </div>

                            <!-- Permissons (Multi-select) -->
                            <fieldset class="relative z-0 p-2 mb-3 bg-gray-50 rounded-md shadow-md">
                                <legend class="absolute text-gray-500 transform scale-50 -top-4 left-2 origin-0 bg-gray-50 px-1">Elegir permisos</legend>
                                <div class="block pt-3 pb-2 space-y-2">
                                    @foreach ($permissions as $permission)
                                        <label class="flex items-center pb-2 text-gray-700">
                                            <input
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->name }}"
                                                class="mr-3 h-4 w-5 text-black border-2 rounded-md"
                                                {{ in_array($permission->name, session('userPermissions', [])) ? 'checked' : '' }} />
                                            <span class="text-sm">{{ ucfirst($permission->name) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>

                            <button
                                type="submit"
                                class="px-3 py-2 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
                                style="background-color: #FF5733;">
                                Crear Rol
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
