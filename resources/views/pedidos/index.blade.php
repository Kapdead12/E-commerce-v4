@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Mis Pedidos'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Mis Pedidos</h5>
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
                        <!-- Mostrar pedidos -->
                        @if ($pedidos->isEmpty())
                            <div class="text-center">
                                <p>No tienes pedidos registrados.</p>
                            </div>
                        @else
                            <div class="container">
                                <div class="row">
                                    @foreach ($pedidos as $pedido)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Pedido ID. {{ $pedido->id }}</h5>
                                                    @if ($pedido->envio)
                                                        <p class="card-text"><strong>Envio ID:</strong> {{ $pedido->envio->id }}</p>
                                                    @else
                                                        <p class="card-text"><strong>Envio:</strong> No asignado</p>
                                                    @endif
                                                    <p class="card-text"><strong>Fecha:</strong> {{ $pedido->created_at->format('d-m-Y H:i') }}</p>
                                                    <p class="card-text"><strong>Total:</strong> $ {{ number_format($pedido->total, 2) }}</p>
                                                    <p class="card-text">
                                                        <strong>Estado:</strong> 
                                                        <span class="badge {{ $pedido->estado == 'en proceso' ? 'bg-secondary' : ($pedido->estado == 'completado' ? 'bg-success' : 'bg-light') }} text-white">
                                                            {{ $pedido->estado }}
                                                        </span>
                                                    </p>

                                                    <!-- Mostrar productos de este pedido -->
                                                    <h6>Productos:</h6>
                                                    <ul class="list-group py-2">
                                                        @foreach ($pedido->productos as $producto)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    {{ $producto->name }} <span class="badge bg-success">unid. {{ $producto->pivot->cantidad }}</span>
                                                                </div>
                                                                <span class="badge bg-danger">$ {{ number_format($producto->price * $producto->pivot->cantidad, 2) }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <!--
                                                    @if ($pedido->estado == 'completado') 
                                                    <div class="px-6 pt-1 pb-2">
                                                        <form action="{{ route('pedidos.eliminar', ['id' => $pedido->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este envío?');" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-block text-md">Eliminar</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                    -->
                                                </div>
                                            </div>
                                        </div>
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
