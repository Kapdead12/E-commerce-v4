@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Gestión de Permisos'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="px-5 py-4 bg-white border-0 shadow-lg sm:rounded-3xl">
                        <h1 class="text-2xl font-bold mb-4">Crear Nuevo Permiso</h1>

                        @if (session('message'))
                            <div class="alert alert-success text-white" role="alert" style="background-color: #28a745; border-color: #28a745;">
                                <strong>{{ session('message') }}</strong>
                            </div>
                        @endif

                        <form action="{{ route('permisos.store') }}" method="POST" novalidate>
                            @csrf

                            <!-- Input dinámico para agregar permisos -->
                            <div id="permissions-list" class="mb-3">
                                <label for="permissions" class="form-label">Permisos</label>

                                <!-- Primer campo de permiso -->
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control permission-input" name="permissions[]" placeholder="Nombre del permiso" required>
                                    <button type="button" class="btn btn-outline-danger remove-permission-btn">-</button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-primary add-permission-btn mb-1">+ Añadir Permiso</button>
                            
                            <div class="mb-1">
                                <button type="submit" class="px-3 py-2 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none" style="background-color: #FF5733;">
                                    Crear Permisos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection