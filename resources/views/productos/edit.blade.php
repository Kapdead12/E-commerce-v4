<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        MARKETCRAFT
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/edituser.css') }}" rel="stylesheet" />
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" />
    @livewireStyles

    <script>
        function updateImageCount() {
            const input = document.querySelectorAll('input[name="images[]"]');
            const countDisplay = document.getElementById('image-count');
            const fileCount = input.length; // Número de campos de archivo
            countDisplay.textContent = `Imágenes seleccionadas: ${fileCount}`;
        }

        function removeImage(event) {
            const imageItem = event.target.parentNode; // Obtiene el elemento padre (div de la imagen)
            imageItem.remove(); // Elimina ese elemento del DOM
            updateImageCount(); // Llama a la función que actualiza el conteo de imágenes
        }
        
        function addImageField() {
            const imageContainer = document.getElementById('image-container');
            const newField = document.createElement('div');
            newField.className = 'image-field mb-2';
            newField.innerHTML = `
                <input type="file" name="images[]" accept="image/*" class="form-control-file px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                <button type="button" class="btn btn-danger mt-1" onclick="removeImage(event)">Eliminar</button>
            `;
            imageContainer.appendChild(newField);
            updateImageCount();
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateImageCount(); // Inicializa el contador al cargar la página
        });
    </script>
</head>
<body>
<div class="flex justify-end">
    <div class="max-d-md mx-auto my-1 bg-white dark:bg-gray-800 p-5 rounded-md shadow-sm">
        <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Editar Producto</h1>
            <p class="text-gray-400 dark:text-gray-400">Modifica los detalles del producto.</p>
        </div>
        <div class="m-2">
        <form action="{{ route('productos.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Esto es importante para el método PUT -->

            <!-- Nombre del Producto -->
            <div class="form-group">
                <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Nombre del Producto</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="Nombre del producto" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            </div>

            <!-- Descripción del Producto -->
            <div class="form-group">
                <label for="description" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Descripción</label>
                <input type="text" name="description" id="description" value="{{ old('description', $product->description) }}" placeholder="Descripción" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            </div>

            <!-- Precio del Producto -->
            <div class="form-group">
                <label for="price" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Precio</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="100" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            </div>

            <!-- Stock del Producto -->
            <div class="form-group">
                <label for="stock" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" placeholder="0" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
            </div>

            @if(auth()->user()->hasRole('administrador'))
                <!-- Usuario del Producto -->
                <div class="form-group mb-4">
                    <label for="user_id" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Usuario</label>
                    <select name="user_id" id="user_id" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                        <option value="">Selecciona un usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $product->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->id." ".$user->name." ".$user->surname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Categoría del Producto -->
            <div class="form-group mb-4">
                <label for="category_id" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Categoría</label>
                <select name="category_id" id="category_id" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Comunidad del Producto -->
            <div class="form-group mb-4">
                <label for="comunidad_id" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Comunidad</label>
                <select name="comunidad_id" id="comunidad_id" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                    <option value="">Selecciona una comunidad</option>
                    @foreach ($communities as $community)
                        <option value="{{ $community->id }}" {{ old('comunidad_id', $product->comunidad_id) == $community->id ? 'selected' : '' }}>{{ $community->name }}</option>
                    @endforeach
                </select>
            </div> 
        
            <!-- Subir Imágenes del Producto -->
            <div class="form-group">
                <label for="images" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Imágenes del Producto</label>
                <div id="image-container" class="grid grid-cols-3 gap-2 mb-4">
                    <!-- Mostrar imágenes actuales -->
                    @php
                        $images = json_decode($product->images, true);
                    @endphp
                    @if(isset($images) && is_array($images) && count($images) > 0)
                        @foreach ($images as $image)
                            <div class="image-field flex flex-col items-center bg-gray-50 p-3 rounded-md shadow-sm w-full">
                                <img src="{{ asset('storage/' . $image) }}" alt="Imagen del producto" class="w-full max-w-xs h-auto object-cover mb-2 rounded-md">
                                
                                <div class="flex flex-col items-center w-full">
                                    <label for="remove_image_{{ $loop->index }}" class="text-sm text-gray-600 dark:text-gray-400 mb-1">Eliminar</label>
                                    <input type="checkbox" name="remove_images[]" value="{{ $image }}" id="remove_image_{{ $loop->index }}" class="h-4 w-4 text-red-500 border-gray-300 rounded transform scale-150">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay imágenes disponibles.</p>
                    @endif
                </div>
                
                <input type="file" name="images[]" accept="image/*" class="form-control-file px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">

                <button type="button" class="btn btn-primary mt-2" onclick="addImageField()">Agregar otra imagen</button>
                <div id="image-count" class="mt-2 text-sm text-gray-600 dark:text-gray-400">Imágenes seleccionadas: {{ isset($images) ? count($images) : 0 }}</div>
            </div>

            <!-- Botón para actualizar producto -->
            <div class="mb-2 mt-3">
                <button type="submit" class="w-full px-2 py-2 text-white bg-green-500 rounded-md focus:bg-green-600 focus:outline-none">Actualizar Producto</button>
            </div>
        </form>

        </div>
    </div>
</div>

</body>

</html>
