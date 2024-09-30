<svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!-- Definir un círculo que enmascara la imagen -->
    <defs>
        <clipPath id="circleView">
            <circle cx="24" cy="24" r="24" />
        </clipPath>
    </defs>

    <!-- Imagen ajustada al círculo -->
    <image href="{{ asset('images/Logo.png') }}" width="48" height="48" clip-path="url(#circleView)" preserveAspectRatio="xMidYMid slice" />
</svg>
