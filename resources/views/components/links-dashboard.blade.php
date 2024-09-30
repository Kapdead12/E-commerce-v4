<nav>
    <ul>
        <!-- Mostrar pestañas del Administrador -->
        @if(auth()->user()->hasRole('admin'))
            <li><a href="{{ url('/gestion-productos') }}">Gestión de Productos</a></li>
            <li><a href="{{ url('/gestion-usuarios') }}">Gestión de Usuarios</a></li>
            <li><a href="{{ url('/gestion-pedidos') }}">Gestión de Pedidos</a></li>
            <li><a href="{{ url('/reseñas') }}">Reseñas</a></li>
            <li><a href="{{ url('/promociones-descuentos') }}">Promociones y Descuentos</a></li>
            <li><a href="{{ url('/categorias-productos') }}">Categorías de Productos</a></li>
            <li><a href="{{ url('/reportes') }}">Reportes</a></li>
        @endif

        <!-- Mostrar pestañas del Comerciante -->
        @if(auth()->user()->hasRole('comerciante'))
            <li><a href="{{ url('/mis-productos') }}">Mis Productos</a></li>
            <li><a href="{{ url('/pedidos') }}">Pedidos</a></li>
            <li><a href="{{ url('/reseñas-productos') }}">Reseñas de Productos</a></li>
            <li><a href="{{ url('/promociones') }}">Promociones</a></li>
            <li><a href="{{ url('/carrito-compras') }}">Carrito de Compras</a></li>
        @endif

        <!-- Mostrar pestañas del Delivery -->
        @if(auth()->user()->hasRole('delivery'))
            <li><a href="{{ url('/pedidos-disponibles') }}">Pedidos Disponibles</a></li>
            <li><a href="{{ url('/mis-entregas') }}">Mis Entregas</a></li>
        @endif
    </ul>
</nav>
