@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<style>
/* Estilos para el encabezado */
.carousel-item {
        width: 500x; /* Ajusta al tamaño deseado */
        height: 500px; /* Ajusta al tamaño deseado */
        overflow: hidden; /* Oculta el desbordamiento de la imagen */
    }

    .carousel-item img {
        width: 80%; /* La imagen ocupará todo el ancho del contenedor */
        height: 90%; /* La imagen ocupará toda la altura del contenedor */
        object-fit: cover; /* Mantiene la proporción y recorta si es necesario */
    }

header img {
    margin: 10px;
    width: 90px;
    position: absolute;
    left: 50px;
}
header {
    width: 100%;
    min-height: 85px;
    background: rgb(29, 7, 89);
    display: flex;
    align-items: center;
    position: relative;
}

/* Estilos para el menú de navegación */

/* Sección principal del contenido */
section .container {
    width: 100%;
}
.slides {
    width: 100%;
    position: relative;
    animation: fade 1s ease-in-out;
}
.slides img {
    width: 100%;
    height: auto;
    object-fit: cover;
    filter: brightness(80%);
}
.slides .content {
    position: absolute;
    left: 50px;
    bottom: 160px;
    color: white;
    max-width: 478px;
    top: 30%;
}

</style>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detalles'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Detalles</h5>
                </div>

                <section>
                    <div class="container">
                        <div class="slides">
                            @php
                                $images = json_decode($product->images, true);
                            @endphp
                            <div id="carouselExample{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @if ($images && count($images) > 0)
                                        @foreach ($images as $index => $image)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Imagen del Producto" class="d-block img-fluid rounded shadow">
                                            </div>
                                        @endforeach
                                    @else
                                        <img src="{{ asset('default-avatar.png') }}" class="avatar me-3" alt="Imagen predeterminada">
                                    @endif
                                </div>

                                <!-- Botones del carrusel -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $product->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" style="background-color: rgba(255, 255, 0, 0.6);" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $product->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" style="background-color: rgba(255, 255, 0, 0.6);" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>
                            <div class="content text-white shadow p-1 ">
                                    <h2 class="fs-1 text-white">{{ $product->name }}</h2>
                                    <p class="lead">{{ $product->description }}</p>
                                    <p class="fs-4"><strong>Precio:</strong> {{ $product->price }}</p>
                                    <p class="fs-5"><strong>Categoría:</strong> {{ $product->category->name }}</p>
                                    <p class="fs-5"><strong>Comunidad:</strong> {{ $product->comunidad->name }}</p>
                                    
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
