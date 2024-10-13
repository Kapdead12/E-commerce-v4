<div class="table-responsive p-0">
    @if (session('message'))
        <div class="alert alert-success text-white" role="alert" style="background-color: #28a745; border-color: #28a745;">
            <strong>{{ session('message') }}</strong>
        </div>
     @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mb-4 px-3 py-1">
        <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
    </div>

    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Photo</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Surname</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create Date</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div>
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="avatar me-3" alt="image">
                            @else
                                <img src="{{ asset('default-avatar.png') }}" class="avatar me-3" alt="default image">
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-1 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->surname }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-sm font-weight-bold mb-0">{!! $user->getRoleNames()->implode('<br>') !!}</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <p class="text-sm font-weight-bold mb-0">{{ $user->created_at->format('d/m/Y') }}</p>
                </td>
                <td class="align-middle text-end">
                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                        <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-success me-2" href="{{ route('users.edit', $user->id) }}">Editar Rol</a>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                            <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-danger me-2" 
                            href="#" 
                            onclick="event.preventDefault(); 
                                        if(confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                        }">
                                Eliminar
                            </a>
                        @can('gestionar permisos') 
                            <a class="text-sm font-weight-bold mb-0 cursor-pointer btn" style="background-color: yellow; color: black;" href="{{ route('users.permisos', $user->id) }}">Permisos</a>
                        @endcan
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-between items-center px-4 py-3">
        <div class="text-sm text-slate-500">
                {{ $users->links() }}
        </div>
    </div>

</div>

