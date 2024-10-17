@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function removeFromCart(productId, cantidad) {
        // Enviar la solicitud de eliminación con la cantidad
        fetch(`/carrito/remove/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cantidad: cantidad })
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload(); // Recargar la página para actualizar el carrito
            } else {
                alert('Error al eliminar el producto.');
            }
        });
    }
</script>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Carrito'])

        <div class="row mt-4 mx-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Carrito</h5>
                    </div>
                    
                    <div class="table-responsive p-0">

                        <div class="card-body px-0 pt-0 pb-0">
                            @if (empty($products))
                                <div class="card-header pb-0">
                                    <p>No tienes productos en tu carrito.</p>
                                </div>
                            @else
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Precio</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cantidad</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">A eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $productId => $product)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-0">
                                                        <div>
                                                            <h6 class="mb-0 text-sm">{{ $product['product_id'] }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-3 py-0">
                                                        <div>
                                                            <h6 class="mb-0 text-sm">{{ $product['name'] }}</h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex px-1 py-0">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-sm font-weight-bold mb-0">$ {{ $product['price'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex px-5 py-0">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-sm font-weight-bold mb-0">{{ $product['cantidad'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex px-3 py-0">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-sm font-weight-bold mb-0">$ {{ $product['price'] * $product['cantidad'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex px-3 py-0">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <div class="align-middle text-center text-sm">
                                                                <button type="button" 
                                                                        class="text-xs btn-danger rounded font-weight-bold mb-0 cursor-pointer p-2 shadow transition duration-300 ease-in-out custom-button" 
                                                                        onclick="removeFromCart('{{ $productId }}', document.getElementById('remove-cantidad-{{ $productId }}').value)">
                                                                        Eliminar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="d-flex flex-column justify-content-center">
                                                        <input type="number" id="remove-cantidad-{{ $productId }}" value="1" min="1" max="{{ $product['cantidad'] }}" class="form-control text-center" style="width: 60px;">
                                                        </div>
                                                    </div>
                                                </td>

                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-header pb-0">
                                    @php
                                        $total = 0;
                                        foreach ($products as $product) {
                                            $total += $product['price'] * $product['cantidad'];
                                        }
                                    @endphp
                                    <h5>Total: $ {{ $total }}</h5>
                                </div>
                                <div class="d-flex px-3 py-2">
                                    <form id="checkout-form" action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="total" value="{{ $total }}">
                                        <button type="submit" class="btn btn-success">Comprar</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

