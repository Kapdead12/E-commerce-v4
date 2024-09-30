@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-base font-bold leading-5 text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' // Blanco y negrita para activo
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-bold leading-5 text-black hover:text-gray-300 hover:border-gray-300 focus:outline-none focus:text-gray-400 focus:border-gray-300 transition duration-150 ease-in-out'; // Negro y negrita para defecto
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>


