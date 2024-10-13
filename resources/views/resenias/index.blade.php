@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Reseñas'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="font-bold text-lg">Reseñas de {{ $product->name }}</h6>
                </div>
                <div class="card-body px-0 pt-2 pb-2">
                    <div class="table-responsive p-0">
                        @if($reseñas->isEmpty())
                            <p class="text-gray-500 px-4">No hay reseñas para este producto.</p>
                        @else
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Calificación</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comentario</th>
                                        @if (Auth::user()->hasRole('administrador'))
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reseñas as $reseña)
                                        <tr> <!-- Abre la fila aquí -->
                                            <td>
                                                <div class="d-flex px-4 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            <span class="text-gray-600">
                                                                @switch($reseña->calificacion)
                                                                    @case(1)
                                                                        Muy Malo
                                                                        @break
                                                                    @case(2)
                                                                        Malo
                                                                        @break
                                                                    @case(3)
                                                                        Regular
                                                                        @break
                                                                    @case(4)
                                                                        Bueno
                                                                        @break
                                                                    @case(5)
                                                                        Excelente
                                                                        @break
                                                                    @default
                                                                        Sin Calificación
                                                                @endswitch
                                                            </span>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $reseña->calificacion)
                                                                    <span class="text-yellow-500">⭐</span> <!-- Estrella llena -->
                                                                @else
                                                                    <span class="text-gray-300">⭐</span> <!-- Estrella vacía -->
                                                                @endif
                                                            @endfor
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex px-4 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $reseña->comentario }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            @if (Auth::user()->hasRole('administrador'))
                                            <td class="align-middle text-end">
                                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                    <form action="{{ route('resenias.destroy', $reseña->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reseña?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm me-2 font-weight-bold mb-0 cursor-pointer btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                            @endif
                                        </tr> <!-- Cierra la fila aquí -->
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
