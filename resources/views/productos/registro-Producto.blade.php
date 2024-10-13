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
</head>
<body>
<div class="flex justify-end">
    <div class="max-d-md mx-auto my-1 bg-white dark:bg-gray-800 p-5 rounded-md shadow-sm">
        <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Agregar Producto</h1>
            <p class="text-gray-400 dark:text-gray-400">Rellena el formulario para agregar un nuevo producto.</p>
        </div>
        <div class="m-2">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Nombre del Producto -->
                <div class="form-group">
                    <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Nombre del Producto</label>
                    <input type="text" name="name" id="name" placeholder="Nombre del producto" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Descripción del Producto -->
                <div class="form-group">
                    <label for="description" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Descripción</label>
                    <input type="text" name="description" id="description" placeholder="Descripción" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Precio del Producto -->
                <div class="form-group">
                    <label for="price" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Precio</label>
                    <input type="number" name="price" id="price" placeholder="100" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Stock del Producto -->
                <div class="form-group">
                    <label for="stock" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Stock</label>
                    <input type="number" name="stock" id="stock" placeholder="0" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Categoría del Producto -->
                <div class="form-group mb-4">
                    <label for="category_id" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Categoría</label>
                    <select name="category_id" id="category_id" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Comunidad del Producto -->
                <div class="form-group mb-4">
                    <label for="comunidad_id" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Comunidad</label>
                    <select name="comunidad_id" id="comunidad_id" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                        <option value="">Selecciona una comunidad</option>
                        @foreach ($communities as $community)
                            <option value="{{ $community->id }}" {{ old('comunidad_id') == $community->id ? 'selected' : '' }}>
                                {{ $community->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Subir Imágenes del Producto -->
                <div class="form-group">
                    <label for="images" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Imágenes del Producto</label>
                    <input type="file" name="images[]" id="images" accept="image/*" multiple class="form-control-file px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                </div>

                <!-- Botón para agregar producto -->
                <div class="mb-2 mt-3">
                    <button type="submit" class="w-full px-2 py-2 text-white bg-green-500 rounded-md focus:bg-green-600 focus:outline-none">Agregar Producto</button>
                </div>


            </form>
        </div>
    </div>
</div>

</body>

</html>
