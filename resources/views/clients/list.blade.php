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
                <div class="my-card p-4 mb-4 shadow-sm mx-auto perfil-cliente-ordenes">
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
                            'approved' => 'Aprobado',
                            'rejected' => 'Rechazado',
                            'in_progress' => 'En progreso',
                            'completed' => 'Completado',
                        ];
                    @endphp
                    @if ($client->orders->isEmpty())
                        <div class="bg-light rounded text-black">
                            <p class="my-3 p-3">Sin servicios contratados.</p>
                        </div>

                    @else
                        @foreach ($client->orders as $order)
                            <div class="mb-4 p-3 bg-light rounded text-black">
                                <h3 class="mb-2">
                                    Pedido #{{ $order->id }} - Fecha: {{ $order->created_at->format('d/m/Y') }}
                                </h3>
                                <p>
                                    Estado: {{ $statusTranslations[$order->status] ?? ucfirst($order->status) }}
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
