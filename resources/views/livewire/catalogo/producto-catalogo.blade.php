<div class="container mx-auto p-4">
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
    <div class="mb-4 px-3 py-0">
        <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
    </div>

    <div class="mb-4 px-3">
        <label for="categorySelect" class="form-label">Selecciona una categoría:</label>
        <select wire:model="selectedCategory" id="categorySelect" class="form-select">
            <option value="">Todas las categorías</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4 px-3">
        <label for="communitySelect" class="form-label">Selecciona una comunidad:</label>
        <select wire:model="selectedCommunity" id="communitySelect" class="form-select">
            <option value="">Todas las comunidades</option>
            @foreach ($communities as $community)
                <option value="{{ $community->id }}">{{ $community->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <div class="mb-4">
                <div class="card">
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
                                <img src="{{ asset('default-avatar.png') }}" class="avatar me-3 " alt="default image">
                            @endif
                        </div>

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
                        <h6 class="elementor-heading-title elementor-size-default center-align text-center">{{ $product->name }}</h6>
                        <div class="text-center py-1">
                            <span id="stock-{{ $product->id }}" class="text-xs badge {{ $product->stock > 10 ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->stock }} unid.
                            </span>
                        </div>
                        <div class="text-center py-1">
                            @if($product->promociones->isNotEmpty())
                                <h6 class="mb-0 text-sm">
                                    <span class="line-through">$ {{ number_format($product->price, 2) }}</span> 
                                    @foreach($product->promociones as $promocion)
                                        <span style="font-size: 0.9em; color: red;">{{ $promocion->desc_porcentaje }}%</span>
                                    @endforeach
                                </h6>
                                @php
                                    $discountedPrice = $product->price;
                                    foreach ($product->promociones as $promotion) {
                                        $discountedPrice -= ($product->price * ($promotion->desc_porcentaje / 100));
                                    }
                                @endphp
                                <h6 class="mb-0 text-sm">$ {{ number_format($discountedPrice, 2) }}</h6>
                            @else
                                <h6 class="mb-0 text-sm">$ {{ number_format($product->price, 2) }}</h6>
                            @endif
                        </div>

                       <!-- Campo de cantidad -->
                       <div class="d-flex justify-content-center mb-3">
                            <input type="number" id="cantidad-{{ $product->id }}" value="1" min="1" max="{{ $product->stock }}" class="form-control text-center" style="width: 60px;" oninput="validateQuantity({{ $product->id }}, {{ $product->stock }})">
                        </div>

                        <!-- Botón para agregar al carrito -->
                        <div class="d-flex justify-content-center mb-2">
                            <button class="text-sm font-weight-bold mb-0 cursor-pointer p-2 shadow transition duration-300 ease-in-out custom-button" 
                                    style="background-color: #FFC300; color: black;" 
                                    onclick="add({{ $product->id }}, document.getElementById('cantidad-{{ $product->id }}').value)">
                                <i class="fas fa-shopping-cart"></i> Agregar al carrito
                            </button>
                        </div>

                        <div class="d-flex justify-content-center mb-2 py-2">
                            <!-- Botón para ver detalles del producto -->
                            <a class="text-xs font-weight-bold mb-0 cursor-pointer btn-warning p-2 shadow hover:bg-red-600 transition duration-300 ease-in-out mr-2" href="{{ route('productos.show', $product->id) }}">
                                Ver detalles
                            </a>

                            <!-- Botón para dar reseña -->
                            <a class="text-xs font-weight-bold mb-0 cursor-pointer btn-info p-2 shadow hover:bg-red-600 transition duration-300 ease-in-out mr-2" href="{{ route('resenias.create', $product->id) }}">
                                Dar reseña
                            </a>
                        </div>
                        <div class="d-flex justify-content-center mb-2 py-2">
                            <span class="text-gray-500 text-center">
                                @if ($product->reseñas->count() > 0)
                                    @php
                                        $promedio = number_format($product->reseñas->avg('calificacion'), 1);
                                        $fullStars = floor($promedio); // Estrellas llenas
                                        $halfStar = $promedio - $fullStars >= 0.5 ? 1 : 0; // Estrella media
                                        $emptyStars = 5 - $fullStars - $halfStar; // Estrellas vacías
                                    @endphp
                                    
                                    {{-- Estrellas llenas --}}
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star text-yellow-500"></i>
                                    @endfor
                                    
                                    {{-- Estrella media --}}
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt text-yellow-500"></i>
                                    @endif
                                    
                                    {{-- Estrellas vacías --}}
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star text-yellow-500"></i>
                                    @endfor
                                    
                                    {{-- Calificación numérica debajo de las estrellas --}}
                                    <div class="text-xl text-gray-700 mt-1">{{ $promedio }} ⭐</div>
                                @else
                                    <strong>Sin Reseñas</strong>
                                @endif
                            </span>
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

<!-- Agrega el script necesario -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function add(productId, cantidad, discountedPrice) {
        fetch(`/carrito/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cantidad: cantidad, price: discountedPrice }) // Enviar precio con descuento
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.success); 
                
                // Actualizar el stock en la vista
                document.getElementById(`stock-${productId}`).innerText = data.nuevoStock + " unid.";

            } else {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al agregar el producto al carrito.');
        });
    }
</script>