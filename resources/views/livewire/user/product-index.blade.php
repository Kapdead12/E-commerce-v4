<div class="table-responsive p-0">
    @if (session('message'))
    <div class="px-3 pt-0 pb-2">
        <div class="alert alert-success text-white " role="alert" style="background-color: #28a745; border-color: #28a745;">
            <strong>{{ session('message') }}</strong>
        </div>
    </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
             {{ session('error') }}
        </div>
    @endif
    <div class="mb-4 px-3 py-1">
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

    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Photo</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Promocion</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User id</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category id</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comunidad id</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div>
                            @php
                                $images = json_decode($product->images, true);
                            @endphp
                            @if ($images)
                                <img src="{{ asset('storage/' . $images[0]) }}" class="avatar me-3" alt="image">
                            @else   
                                <img src="{{ asset('default-avatar.png') }}" class="avatar me-3" alt="default image">
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->name}}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->description }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-0 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->price }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-0 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            @if($product->promociones->isNotEmpty())
                                @foreach($product->promociones as $promotion)
                                    <h6 class="mb-0 text-sm">{{ $promotion->name }}</h6>
                                @endforeach
                            @else
                                <h6 class="mb-0 text-sm">Sin promociones</h6>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-5 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->stock }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->user->name." ".$product->user->surname }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->category->name}}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->comunidad->name}}</h6>
                        </div>
                    </div>
                </td>

                <td class="align-middle text-end">
                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                        <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-success me-2" href="{{ route('productos.edit', $product->id) }}">Editar</a>
                        <form action="{{ route('productos.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm me-2 font-weight-bold mb-0 cursor-pointer btn btn-danger">Eliminar</button>
                        </form>
                        <a class="text-sm font-weight-bold mb-0 cursor-pointer btn btn-info me-2" 
                            href="{{ route('resenias.index', $product->id) }}" 
                            style="background: #F1C40F;">
                            Reseñas
                        </a>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-between items-center px-4 py-3">
        <div class="text-sm text-slate-500">
                {{ $products->links() }}
        </div>
    </div>

</div>

