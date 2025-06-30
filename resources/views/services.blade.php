<x-layout>
    <x-slot:title>Servicios</x-slot:title>
    <h1 class="mb-3 text-center">Nuestros servicios</h1>

    <div class="d-flex justify-content-center gap-3 mb-2">
        <a href="{{ route('orders.create') }}" class="btn-pink">Contratar servicios</a>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('services.create') }}" class="btn btn-secondary">Agregar nuevo servicio</a>
            @endif
        @endauth
    </div>

    <div class="container mb-3">
        <h2 class="mb-3">Software</h2>
        <div class="row">
            @foreach ($services as $service)
                @if ($service->featured && $service->category_id === 1)
                    <x-service-card :service="$service" />
                @endif
            @endforeach
        </div>
    </div>

    <div class="container mb-3">
        <h2 class="mb-3">Hardware</h2>
        <div class="row">
            @foreach ($services as $service)
                @if ($service->featured && $service->category_id === 2)
                    <x-service-card :service="$service" />
                @endif
            @endforeach
        </div>
    </div>
</x-layout>
