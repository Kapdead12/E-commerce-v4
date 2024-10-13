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
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    
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
            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Agregar Promocion</h1>
            <p class="text-gray-400 dark:text-gray-400">Rellena el formulario para agregar una nueva promocion.</p>
        </div>
        <div class="m-2">
            <form action="{{ route('promociones.store') }}" method="POST">
                @csrf
                <!-- Seleccionar Producto -->
                <div class="form-group">
                    <label for="product_id" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Seleccionar Producto</label>
                    <select name="product_id" id="product_id" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nombre de la Promoción --> 
                <div class="form-group">
                    <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Nombre de la Promoción</label>
                    <input type="text" name="name" id="name" placeholder="Nombre de la promoción" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Descripción de la Promoción -->
                <div class="form-group">
                    <label for="description" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Descripción</label>
                    <input type="text" name="description" id="description" placeholder="Descripción" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- % Descuento -->
                <div class="form-group">
                    <label for="desc_porcentaje" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">% Descuento</label>
                    <input type="number" name="desc_porcentaje" id="desc_porcentaje" placeholder="100" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Fecha de inicio -->
                <div class="form-group">
                    <label for="start_date" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <!-- Fecha de fin -->
                <div class="form-group">
                    <label for="end_date" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Fecha de Fin</label>
                    <input type="date" name="end_date" id="end_date" required class="form-control px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>

                <div class="mb-2 mt-3">
                    <button type="submit" class="w-full px-2 py-2 text-white bg-black rounded-md focus:bg-gray-700 focus:outline-none">Agregar Promoción</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>



