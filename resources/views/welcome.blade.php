<x-layout>
    <x-slot:title>Página Principal</x-slot:title>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-auto w-25" role="alert">
            {!! session()->get('error') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $user = auth()->user();
    @endphp

    @if ($user && $user->role === 'admin')
        <div class="container">
            <div class="mb-4 d-flex justify-content-center mx-auto custom-mq">
                <img src="{{ url('img/logo.png') }}" alt="Logo de TecnoFix" class="d-block w-75 border-bottom-pink pb-2">
            </div>
            <h1 class="mb-4 text-center">Dashboard Administrativo</h1>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 d-flex justify-content-center">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-title fs-5">Clientes</p>
                            <p class="card-text fs-2">{{ $totalClients }}</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-title fs-5">Total facturado</p>
                            <p class="card-text fs-2">${{ $totalBilled }}</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-title fs-5">Posts <span class="smaller-txt text-secondary">(publicados / totales)</span></p>
                            <p class="card-text fs-2 mb-2">
                                {{ $totalFeaturedPosts }} / {{ $totalPosts }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-title fs-5">Servicios <span class="smaller-txt text-secondary">(publicados / totales)</span></p>
                            <p class="card-text fs-2 mb-2">
                                {{ $totalFeaturedServices }} / {{ $totalServices }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center my-5">
                <a href="{{ route('clients.list') }}" class="btn-pink">Ir a lista de clientes</a>
            </div>
            <div class="my-3 custom-mq mx-auto">
                <h2 class="mb-3 text-center">Servicios más contratados</h2>
                <div class="my-card p-4 mb-4 shadow-sm">
                    @if ($topServices->isEmpty())
                        <p>No hay datos suficientes.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($topServices as $service)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $service->name }}
                                    <span class="badge bg-secondary rounded-pill">{{ $service->total }} pedidos</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="my-5 custom-mq mx-auto">
                <h2 class="mb-3 text-center">Mes con mayor facturación</h2>
                <div class="my-card p-4 mb-4 shadow-sm">
                    @if ($bestMonth)
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Mes</span>
                                <span class="fw-bold">{{ $bestMonth->month }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total</span>
                                <span class="fw-bold">${{ $bestMonth->total }}</span>
                            </li>
                        </ul>
                    @else
                        <p class="text-center mb-0">No hay datos disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row d-flex flex-column-reverse flex-md-row">
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="p-4">
                        <h1 class="d-none">TecnoFix</h1>
                        <img src="{{ url('img/logo.png') }}" alt="Logo de TecnoFix" class="d-block w-75">
                        <p>Servicio técnico a domicilio y en taller. Mantenimiento, instalación, limpieza y todo lo que tu
                            computadora necesita para funcionar al 100%.</p>
                        <a href="{{ route('services') }}" class="btn btn-pink mt-3">Conocé más</a>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center align-content-center div-img-home">
                    <img src="{{ url('img/home.png') }}" alt="Banner de inicio" class="d-block w-100 img-home">
                </div>
            </div>
        </div>
    @endif
</x-layout>
