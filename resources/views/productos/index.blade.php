@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Product Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Productos</h5>
                </div>
                <div class="px-3 pt-1 pb-2">
                    <a href="{{ route('promociones.create') }}" class="btn btn-dark me-2">Agregar Promoción</a>
                    <a href="{{ route('promociones.mostrar') }}" class="btn btn-success">Ver promociones</a>
                </div>

                <div class="card-body px-0 pt-2 pb-2">
                    @livewire('user.product-index')
                </div>
            </div>
            
        </div>
    </div>
@endsection
