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
    @include('layouts.navbars.auth.topnav', ['title' => 'Catalog'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Catalogo</h5>
                </div>
                <div class="px-4 pt-0 pb-2">
                    <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-dark me-5" href="{{ route('carrito.index') }}">Ver Carrito</a>
                </div>
                <div class="card-body px-0 pt-0 pb-0">
                    @livewire('catalogo.producto-catalogo')
                </div>
            </div>
            
        </div>
    </div>
@endsection