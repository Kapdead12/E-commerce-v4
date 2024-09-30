@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="px-5 py-4 bg-white border-0 shadow-lg sm:rounded-3xl">
                        <h1 class="text-2xl font-bold mb-4">Editar Roles de Usuario</h1>

                        @if (session('message'))
                            <div class="alert alert-success text-white" role="alert" style="background-color: #28a745; border-color: #28a745;">
                                <strong>{{ session('message') }}</strong>
                            </div>
                        @endif

                        <!-- Mostrar nombre y apellido del usuario -->
                        <div class="mb-4">
                        <p class="text-gray-700 font-bold">Nombre Completo : 
                            <span class="font-normal">{{ $user->name . ' ' . $user->surname }}</span>
                        </p>
                        </div>

                        <form action="{{ route('users.update', $user->id) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Roles (Multi-select) -->
                            <fieldset class="relative z-0 p-2 mb-3 bg-gray-50 rounded-md shadow-md">
                                <legend class="absolute text-gray-500 transform scale-50 -top-4 left-2 origin-0 bg-gray-50 px-1">Elegir roles</legend>
                                <div class="block pt-3 pb-2 space-y-2">
                                    @foreach ($roles as $role)
                                        <label class="flex items-center pb-2 text-gray-700">
                                            <input
                                                type="checkbox"
                                                name="roles[]"
                                                value="{{ $role->name }}"
                                                class="mr-3 h-4 w-5 text-black border-2 rounded-md"
                                                {{ in_array($role->name, $userRoles) ? 'checked' : '' }} />
                                            <span class="text-sm">{{ ucfirst($role->name) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>

                            <button
                                type="submit"
                                class="px-3 py-2 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
                                style="background-color: #FF5733;">
                                Actualizar Roles
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
