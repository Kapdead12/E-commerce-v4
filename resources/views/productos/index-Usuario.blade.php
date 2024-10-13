@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
    .carousel-item {
        width: 240x; /* Ajusta al tamaño deseado */
        height: 190px; /* Ajusta al tamaño deseado */
        overflow: hidden; /* Oculta el desbordamiento de la imagen */
    }

    .carousel-item img {
        width: 100%; /* La imagen ocupará todo el ancho del contenedor */
        height: 90%; /* La imagen ocupará toda la altura del contenedor */
        object-fit: cover; /* Mantiene la proporción y recorta si es necesario */
    }

</style>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'My Products'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Mis Productos</h5>
                </div>
                <div class="px-3 pt-0 pb-2">
                    <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-dark me-2" href="{{ route('productos.create') }}">Agregar Producto</a>
                </div>
                @if (session('message'))
                    <div class="px-3 pt-0 pb-2">
                        <div class="alert alert-success text-white " role="alert" style="background-color: #28a745; border-color: #28a745;">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="px-3 pt-0 pb-2"></div>
                <div class="card-body px-0 pt-2 pb-2">
                    <div class="table-responsive p-0">

                        <!-- Mostrar productos -->
                        <div class="container">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-md-4 mb-4">
                                        <!-- Imagen del producto -->
                                        <div class="card">
                                        @php
                                            $images = json_decode($product->images, true);
                                        @endphp

                                        <div id="carouselExample{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @if ($images)
                                                    @foreach ($images as $index => $image)
                                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Imagen del Producto" class="d-block img-fluid rounded shadow">
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('default-avatar.png') }}" class="avatar me-3 " alt="default image">
                                                @endif
                                            </div>

                                            <!-- Controles del carrusel -->
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $product->id }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" style="background-color: rgba(255, 255, 0, 0.6);" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $product->id }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" style="background-color: rgba(255, 255, 0, 0.6);" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>

                                        </div>

                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">{{ $product->description }}</p>
                                                <p class="card-text"><strong>Precio: </strong> Bs {{ $product->price }}</p>
                                                <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-success me-2" href="{{ route('productos.edit', $product->id) }}">Editar Producto</a>
                                                <form action="{{ route('productos.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-danger">Eliminar</button>
                                                </form>
                                                <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-info me-2" 
                                                    href="{{ route('resenias.index', $product->id) }}" 
                                                    style="background: #F1C40F;">
                                                    Reseñas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Si no hay productos -->
                        @if ($products->isEmpty())
                            <div class="text-center">
                                <p>No tienes productos registrados.</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
