@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Mis Envios'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Envios disponibles</h5>
                </div>

                <!-- Mensajes de éxito y error -->
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
                
                <div class="card-body px-0 pt-2 pb-2">
                    <div class="table-responsive p-0">
                        <!-- Mostrar envíos -->
                        @if ($envios->isEmpty() || $envios->every(fn($envio) => !is_null($envio->usuario_delivery_id)))
                            <div class="text-center">
                                <p>No hay envíos disponibles.</p>
                            </div>
                        @else
                            <div class="container">
                                <div class="row">
                                    @foreach ($envios as $envio)
                                        <!-- Mostrar el envío si está completado o si no tiene un delivery asignado -->
                                        @if ($envio->estado == 'completado' || is_null($envio->usuario_delivery_id))
                                            <div class="col-md-4 mb-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Envio ID. {{ $envio->id }}</h5>
                                                        <p class="card-text"><strong>Fecha de Envío:</strong> {{ $envio->created_at->format('d-m-Y H:i') }}</p>
                                                        <p class="card-text"><strong>Dirección:</strong> {{ $envio->direccion }}</p>
                                                        <p class="card-text">
                                                            <strong>Estado:</strong> 
                                                            <span class="badge bg-dark {{ $envio->estado == 'en proceso' ? 'bg-secondary' : ($envio->estado == 'completado' ? 'bg-success' : 'bg-light') }} text-white">
                                                                {{ $envio->estado }}
                                                            </span>
                                                        </p>

                                                        <!-- Información del delivery -->
                                                        <p class="card-text"><strong>Delivery Asig.</strong> 
                                                            <span class="badge bg-dark {{ $envio->estado == 'en proceso' ? 'bg-secondary' : ($envio->estado == 'completado' ? 'bg-success' : 'bg-light') }} text-white">
                                                                {{ $envio->usuario->name ?? 'No asignado' }}
                                                            </span>
                                                        </p>
                                                        
                                                        <!-- Si el envío no está completado y no tiene delivery asignado, mostrar el botón para tomar -->
                                                        @if ($envio->estado != 'completado' && is_null($envio->usuario_delivery_id))
                                                            <div class="px-6 pt-1 pb-2">
                                                                <form action="{{ route('envios.asignar', ['id' => $envio->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas tomar este envío?');" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Tomar envío</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
