@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="px-5 py-4 bg-white border-0 shadow-lg sm:rounded-3xl">
                        <h1 class="text-2xl font-bold mb-2">Roles y Permisos</h1>
                            <!-- Roles (Multi-select) -->
                            <fieldset class="relative z-0 p-3 mb-3 bg-gray-50 rounded-md shadow-md">
                                <div class="block pt-0 pb-2 space-y-2">
                                    @foreach($roles as $role)
                                        <div class="border-b border-gray-300 pb-2 mb-2">
                                            <h3 class="font-bold text-lg">{{ $role->name }}</h3>
                                            <div>
                                                @if($role->permissions->isEmpty())
                                                    <p class="text-gray-600">Sin permisos</p>
                                                @else
                                                    <ul class="list-disc list-inside pl-5">
                                                        @foreach($role->permissions as $permission)
                                                            <li>{{ $permission->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <h3 class="font-bold text-lg">Permisos sin rol</h3>
                                    @php
                                        $assignedPermissions = $roles->flatMap(function ($role) {
                                            return $role->permissions;
                                        })->pluck('id')->toArray();
                                        $unassignedPermissions = \Spatie\Permission\Models\Permission::whereNotIn('id', $assignedPermissions)->get();
                                    @endphp

                                    @if($unassignedPermissions->isEmpty())
                                        <p class="text-gray-600">No hay permisos sin rol</p>
                                    @else
                                        <ul class="list-disc list-inside pl-5">
                                            @foreach($unassignedPermissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </fieldset>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
