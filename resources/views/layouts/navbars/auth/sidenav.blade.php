<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-2 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav">
        </i>
        <a class="navbar-brand m-2 "
            target="_blank">
            <img src="./images/Logo.png" class="navbar-brand-img h-100 rounded-circle" style="border-bottom: 4py solid #000;" alt="main_logo">
            <span class="ms-1 font-weight-bold">Navegacion</span>
            
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="navbar-collapse collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Perfil</span>
                </a>
            </li>

            @can('gestionar usuarios')  
                <li class="nav-item mt-3 d-flex align-items-center">
                    <div class="ps-4">
                        <i class="fab fab-login" style="color: #f4645f;"></i>
                    </div>
                    <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Administrador</h6>
                </li>  

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gestion de Usuarios</span>
                    </a>
                </li>                
            @endcan

            @can('gestionar productos')   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.index') ? 'active' : '' }}" href="{{ route('productos.index') }}">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestion de Productos</span>
                        </a>
                    </li>
            @endcan

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Comerciante</h6>
            </li>

            @can('ver mis productos') 
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('productos.index-Usuario') ? 'active' : '' }}" href="{{ route('productos.index-Usuario') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mis Productos</span>
                    </a>
                </li>

            @endcan

            @can('ver catalogo') 
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('catalogo.index') ? 'active' : '' }}" href="{{ route('catalogo.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-folder-17 text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Catalogo</span>
                    </a>
                </li>
            @endcan

            @can('ver catalogo') 
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carrito.index') ? 'active' : '' }}" href="{{ route('carrito.index') }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-folder-17 text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ver carrito</span>
                    </a>
                </li>
            @endcan

            @can('gestionar pedidos') 
                
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}" href="{{ route('virtual-reality') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Virtual Reality</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'rtl' ? 'active' : '' }}" href="{{ route('rtl') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">RTL</span>
                    </a>
                </li>
            @endcan
            
            @can('ver pedidos disponibles')  
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Delivery</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'profile-static' ? 'active' : '' }}" href="{{ route('profile-static') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pedidos Disponibles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sign-in-static') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Login</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sign-up-static') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Up</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="/img/illustrations/icon-documentation-warning.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                </div>
            </div>
        </div>
        <a href="/docs/bootstrap/overview/argon-dashboard/index.html" target="_blank"
            class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
        <a class="btn btn-primary btn-sm mb-0 w-100"
            href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank" type="button">Upgrade to PRO</a>
    </div>
</aside>
