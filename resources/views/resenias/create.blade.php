<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKETCRAFT</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen p-12 bg-gray-100">
        <div class="mx-auto w-full max-w-[550px] bg-white rounded-lg shadow-md p-6">
            <!-- Información del producto -->
            <h2 class="text-2xl font-bold text-gray-800 py-2">{{ $product->name }}</h2>
            <p class="text-gray-600 py-2">{{ $product->description }}</p>
            @php
                $images = json_decode($product->images, true);
            @endphp
                    
            <div class="carousel-inner py-1">
                @if ($images && count($images) > 0)
                        <div class="py-1">
                            <img src="{{ asset('storage/' . $images[0]) }}" alt="Imagen del Producto" class="d-block img-fluid rounded shadow">
                        </div>
                @else
                    <img src="{{ asset('default-avatar.png') }}" class="avatar me-3 " alt="default image">
                @endif
            </div>
            
            <form action="{{ route('resenias.store', $product->id) }}" method="POST">
                @csrf  <!-- Agregar esta línea para incluir el token CSRF -->
                
                <div class="mb-5">
                    <label for="comentario" class="mb-3 block text-base font-medium text-[#07074D]">Tu reseña</label>
                    <textarea rows="4" name="comentario" id="comentario" placeholder="Escribe tu mensaje" class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required></textarea>
                </div>
                
                <!-- Campo para la calificación -->
                <div class="w-full mb-4">
                    <label class="mb-3 block text-base font-medium text-[#07074D]">Calificación</label>
                    <select name="calificacion" class="w-full bg-transparent placeholder:text-slate-400 text-slate-300 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" required>
                        <option value="" disabled selected>Selecciona una calificación</option>
                        <option value="1">1 - Muy Malo</option>
                        <option value="2">2 - Malo</option>
                        <option value="3">3 - Regular</option>
                        <option value="4">4 - Bueno</option>
                        <option value="5">5 - Excelente</option>
                    </select>
                </div>

                <!-- Botón para enviar la reseña -->
                <div class="p-6 pt-0">
                    <button 
                        class="rounded-md bg-red-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:bg-red-700 focus:bg-red-700 active:bg-red-800" 
                        type="submit">
                        Enviar Reseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
