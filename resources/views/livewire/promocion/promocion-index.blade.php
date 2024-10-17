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

    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">% Descuento</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inicio</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($promociones as $promocion)
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $promocion->product->name }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $promocion->name}}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $promocion->description }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $promocion->desc_porcentaje }} %</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-5 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $promocion->start_date }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $promocion->end_date}}</h6>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-between items-center px-4 py-3">
        <div class="text-sm text-slate-500">
                {{ $promociones->links() }}
        </div>
    </div>

</div>


