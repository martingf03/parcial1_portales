<x-layout>
    <x-slot:title>Listado de Clientes</x-slot:title>

    <div class="container my-4">
        <h1 class="text-center mb-4">Lista de Clientes</h1>

        @if ($clients->isEmpty())
            <div class="my-card p-4 text-center">
                <p class="mb-0">No hay clientes registrados.</p>
            </div>
        @else
            @foreach ($clients as $client)
                <div class="my-card p-4 mb-4 shadow-sm mx-auto custom-mq">
                    <h2 class="mb-3">{{ $client->name }} {{ $client->surname }}</h2>

                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 fw-bold border-end">Email</div>
                                <div class="col-8">
                                    {{ $client->user->email }}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 fw-bold border-end">Teléfono</div>
                                <div class="col-8">{{ $client->telephone }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 fw-bold border-end">CUIL</div>
                                <div class="col-8">{{ $client->cuil ?? 'No registrado' }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 fw-bold border-end">Dirección</div>
                                <div class="col-8">{{ $client->address }}</div>
                            </div>
                        </li>
                    </ul>


                    <h3 class="mb-2">Servicios Contratados</h3>
                    @php
                        $statusTranslations = [
                            'pending' => 'Pendiente',
                            'paid' => 'Pagado',
                            'completed' => 'Completado',
                            'cancelled' => 'Cancelado',
                        ];
                    @endphp
                    @if ($client->orders->isEmpty())
                        <div class="bg-light rounded text-black">
                            <p class="my-3 p-3">Sin servicios contratados.</p>
                        </div>
                    @else
                        @foreach ($client->orders as $order)
                            @php
                                $badgeClass = match ($order->status) {
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'cancelled' => 'danger',
                                    'completed' => 'primary',
                                    default => 'dark',
                                };
                            @endphp
                            <div
                                class="mb-4 p-3 bg-light rounded text-black {{ $order->status === 'cancelled' ? 'cancelled-order' : 'bg-light' }}">
                                <h3 class="mb-2">
                                    Pedido #{{ $order->id }} - Fecha: {{ $order->created_at->format('d/m/Y') }}
                                </h3>
                                <p class="fs-5">
                                    <span class="badge bg-{{ $badgeClass }}">
                                        {{ $statusTranslations[$order->status] ?? $order->status }}
                                    </span>
                                </p>
                                <div class="pb-4 border-bottom-pink">
                                    <ul class="list-group">
                                        @foreach ($order->services as $service)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>{{ $service->service_name ?? $service->name }}</span>
                                                <span>${{ $service->pivot->price }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p class="mb-3 fw-bold mt-2 fs-5 text-end">Total: ${{ $order->total_price }}</p>
                            </div>
                        @endforeach
                    @endif

                </div>
            @endforeach
        @endif
    </div>
</x-layout>
