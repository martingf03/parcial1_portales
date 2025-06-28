<x-layout>
    <x-slot:title>Mi perfil</x-slot:title>
    <h1 class="d-none">Mi perfil</h1>

    <div class="container my-3">
        <h2 class="text-center mb-4">
            ¡Hola! {{ $client->name }}
        </h2>
        <div class="my-card p-4 shadow-sm mx-auto mb-5 perfil-cliente-ordenes">
            <p class="mb-3 text-center">Tus datos registrados en el sistema son:</p>
            <ul class="list-group w-100">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4 fw-bold border-end">Nombre</div>
                        <div class="col-8"> {{ $client->name }} </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4 fw-bold border-end">Apellido</div>
                        <div class="col-8"> {{ $client->surname }} </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4 fw-bold border-end">Teléfono</div>
                        <div class="col-8"> {{ $client->telephone }} </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4 fw-bold border-end">Email</div>
                        <div class="col-8"> {{ auth()->user()->email }} </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4 fw-bold border-end">Dirección</div>
                        <div class="col-8"> {{ $client->address }} </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-4 fw-bold border-end">CUIL</div>
                        <div class="col-8"> {{ $client->cuil ?? 'No registrado' }} </div>
                    </div>
                </li>
            </ul>
        </div>
        @if (session('success'))
            <div class="alert alert-success w-50 mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <div class="perfil-cliente-ordenes mx-auto">
            <h3 class="mb-3 text-center">Tus pedidos realizados</h3>

            @php
                $statusTranslations = [
                    'pending' => 'Pendiente',
                    'approved' => 'Aprobado',
                    'rejected' => 'Rechazado',
                    'in_progress' => 'En progreso',
                    'completed' => 'Completado',
                ];
            @endphp

            @if (count($orders) > 0)
                @foreach ($orders as $order)
                    <div class="my-card p-4 mb-4 shadow-sm">
                        <p class="mb-2 fw-bold fs-5">Pedido #{{ $order->id }}</p>
                        <div class="mb-4 pb-4 border-bottom-pink">
                            <ul class="list-group">
                                @foreach ($order->services as $service)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $service->service_name }}</span>
                                        <span>${{ $service->pivot->price }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <p class="mb-2 fw-bold fs-5">Total: ${{ $order->total_price }}</p>
                        <p class="mb-2">Tiempo estimado: {{ $order->estimated_days }}
                            {{ $order->estimated_days == 1 ? 'día hábil' : 'días hábiles' }}
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn-pink">Ver detalle</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="my-card">
                    <p class="text-center p-4 my-5">Aún no realizaste ningún pedido.</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
