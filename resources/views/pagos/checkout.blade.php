<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        #card-element {
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-success {
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
        }

        #payment-result {
            color: red;
            margin-top: 10px;
        }
        #order-form {
            display: none; /* Oculta el formulario de pedido inicialmente */
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <h2 class="text-center mb-4">Completa tu Pago</h2>
            <form id="payment-form">
                <div class="form-group py-2">
                    <label for="card-holder-name">Nombre del Titular</label>
                    <input id="card-holder-name" type="text" class="form-control" placeholder="Nombre" value="{{ $user->name .' '. $user->surname }}" required>
                </div>
                
                <div class="form-group py-3">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control" placeholder="Correo Electrónico" value="{{ $user->email }}" required>
                </div>

                <!-- Elemento de tarjeta de pago -->
                <div id="card-element" class="form-control"></div>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa" style="font-size: 32px;"></i> <!-- Icono de Visa -->
                    <i class="fab fa-cc-mastercard" style="font-size: 32px;"></i> <!-- Icono de MasterCard -->
                    <i class="fab fa-paypal" style="font-size: 32px;"></i> <!-- Icono de PayPal -->
                    <i class="fas fa-qrcode" style="font-size: 32px;"></i> <!-- Icono de código QR -->
                    <i class="fas fa-money-bill-wave" style="font-size: 32px;"></i> <!-- Icono de efectivo -->
                </div>


                <button id="submit" class="btn btn-success mt-3">Pagar</button>
                <div id="payment-result" class="mt-3"></div>
            </form>
            
            <form id="order-form" action="{{ route('pedidos.crear') }}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{ $total }}"> <!-- Asegúrate de que esta variable esté definida en tu controlador -->
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de Envío</label>
                    <input type="text" class="form-control" value="{{ $user->address }}" id="direccion" name="direccion" required placeholder="Ingresa tu dirección">
                </div>
                <button type="submit" class="btn btn-danger">Solicitar Pedido</button>
            </form>
        
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const stripe = Stripe('pk_test_51QAQVtHdC2stCdt5mWP3nnFIb903kRFOyfEbZ8aexCIL7ndkQF4snlleQRsNOGGcTKFeBe3p6JzMqEtzDThZPZ1Q00rtBfwd94'); // Cambia esto por tu clave pública de Stripe
        const clientSecret = '{{ $clientSecret }}'; // Se genera desde el backend

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', async (event) => {
            event.preventDefault();

            // Obtener el nombre del titular de la tarjeta
            const cardHolderName = document.getElementById('card-holder-name').value;

            // Confirmar el pago con Stripe
            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName,
                        email: document.getElementById('email').value // Se añade el email a los detalles
                    }
                }
            });

            if (error) {
                // Mostrar error en el formulario
                document.getElementById('payment-result').innerText = error.message;
            } else {
                // El pago fue exitoso
                if (paymentIntent.status === 'succeeded') {
                    // Obtener detalles del método de pago
                    alert('Pago realizado con éxito!');
                    document.getElementById('order-form').style.display = 'block';
                }
            }
        });
    </script>

</body>
</html>
