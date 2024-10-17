@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Promociones'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Promociones</h5>
                </div>
                <div class="card-body px-2 pt-2 pb-2">
                    @livewire('promocion.promocion-index')
                </div>
            </div>
            
        </div>
    </div>
@endsection