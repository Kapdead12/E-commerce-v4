<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="background-color: #FF5733 ; color: white; padding: 10px;">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <!-- Menú desplegable para Administrador -->
                    @if(auth()->user()->hasRole('administrador'))
                    <div class="'block w-full py-4 text-left text-sm leading-5 text-gray-700 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        <x-dropdown align="top" width="48">
                            <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-1 text-base font-bold text-white focus:outline-none transition duration-150 ease-in-out">
                                    {{ __('Gestiones') }}
                                    <svg class="ml-1" fill="currentColor" viewBox="0 0 20 20" width="20" height="20">
                                        <path fill-rule="evenodd" d="M5.5 8l4.5 4 4.5-4H5.5z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Gestión de Usuarios -->
                                <x-dropdown-link href="{{ route('admin.manage-users') }}" :active="request()->routeIs('dashboard')">
                                    {{ __('Gestión de Usuarios') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ url('/gestion-usuarios') }}" :active="request()->routeIs('gestion-usuarios')">
                                    {{ __('Gestión de Productos') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ url('/categorias-productos') }}" :active="request()->routeIs('categorias-productos')">
                                    {{ __('Categorías de Productos') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ url('/reseñas') }}" :active="request()->routeIs('reseñas')">
                                    {{ __('Reseñas') }}
                                 </x-dropdown-link>
                                <x-dropdown-link href="{{ url('/promociones-descuentos') }}" :active="request()->routeIs('promociones-descuentos')">
                                    {{ __('Promociones') }}
                                </x-dropdown-link>
                                <!-- Gestión de Pedidos -->
                                <x-dropdown-link href="{{ url('/gestion-pedidos') }}" :active="request()->routeIs('gestion-pedidos')">
                                    {{ __('Gestión de Pedidos') }}
                                </x-dropdown-link>
                            </x-slot>

                        </x-dropdown>
                    </div>
                    <x-nav-link href="{{ url('/reportes') }}" :active="request()->routeIs('reportes')">
                        {{ __('Reportes') }}
                    </x-nav-link>
                    @endif

                    <!-- Menú desplegable para Comerciante -->
                    @if(auth()->user()->hasRole('comerciante'))
                    <x-dropdown align="top" width="48">
                        <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-5 text-base font-bold text-white focus:outline-none transition duration-150 ease-in-out" style="min-width: 0;">
                            <span class="truncate" style="min-width: 0; white-space: nowrap;">{{ __('Mis Productos') }}</span>
                            <svg class="ml-1" fill="currentColor" viewBox="0 0 20 20" width="20" height="20">
                                <path fill-rule="evenodd" d="M5.5 8l4.5 4 4.5-4H5.5z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ url('/reseñas-productos') }}" :active="request()->routeIs('reseñas-productos')">
                                {{ __('Reseñas de Productos') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ url('/promociones') }}" :active="request()->routeIs('promociones')">
                                {{ __('Promocionar') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <x-nav-link href="{{ url('/pedidos') }}" :active="request()->routeIs('pedidos')">
                        {{ __('Pedidos') }}
                    </x-nav-link>
                    <x-nav-link href="{{ url('/carrito-compras') }}" :active="request()->routeIs('carrito-compras')">
                        {{ __('Carrito') }}
                    </x-nav-link>
                    @endif

                    <!-- Menú desplegable para Delivery -->
                    @if(auth()->user()->hasRole('delivery'))
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                {{ __('Delivery') }}
                                <svg class="ml-1" fill="currentColor" viewBox="0 0 20 20" width="20" height="20">
                                    <path fill-rule="evenodd" d="M5.5 8l4.5 4 4.5-4H5.5z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ url('/pedidos-disponibles') }}" :active="request()->routeIs('pedidos-disponibles')">
                                {{ __('Pedidos Disponibles') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ url('/mis-entregas') }}" :active="request()->routeIs('mis-entregas')">
                                {{ __('Mis Entregas') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @endif
                </div>


            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Inicio') }}
        </x-responsive-nav-link>

        @if(auth()->user()->hasRole('admin'))
        <x-responsive-nav-link href="{{ url('/gestion-usuarios') }}" :active="request()->routeIs('gestion-usuarios')">
            {{ __('Gestión de Usuarios') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/gestion-productos') }}" :active="request()->routeIs('gestion-productos')">
            {{ __('Gestión de Productos') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/categorias-productos') }}" :active="request()->routeIs('categorias-productos')">
            {{ __('Categorías de Productos') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/reseñas') }}" :active="request()->routeIs('reseñas')">
            {{ __('Reseñas') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/promociones-descuentos') }}" :active="request()->routeIs('promociones-descuentos')">
            {{ __('Promociones') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/gestion-pedidos') }}" :active="request()->routeIs('gestion-pedidos')">
            {{ __('Gestión de Pedidos') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/reportes') }}" :active="request()->routeIs('reportes')">
            {{ __('Reportes') }}
        </x-responsive-nav-link>
        @endif

        @if(auth()->user()->hasRole('comerciante'))
        <x-responsive-nav-link href="{{ url('/reseñas-productos') }}" :active="request()->routeIs('reseñas-productos')">
            {{ __('Reseñas de Productos') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/promociones') }}" :active="request()->routeIs('promociones')">
            {{ __('Promocionar') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/pedidos') }}" :active="request()->routeIs('pedidos')">
            {{ __('Pedidos') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/carrito-compras') }}" :active="request()->routeIs('carrito-compras')">
            {{ __('Carrito') }}
        </x-responsive-nav-link>
        @endif

        @if(auth()->user()->hasRole('delivery'))
        <x-responsive-nav-link href="{{ url('/pedidos-disponibles') }}" :active="request()->routeIs('pedidos-disponibles')">
            {{ __('Pedidos Disponibles') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ url('/mis-entregas') }}" :active="request()->routeIs('mis-entregas')">
            {{ __('Mis Entregas') }}
        </x-responsive-nav-link>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
