<x-layout>
    <x-slot:title>Detalle del pedido</x-slot:title>
    <h1 class="d-none">Detalle del pedido</h1>
    <div class="container">
        <h2 class="mb-4 text-center">Pedido #{{ $order->id }}</h2>

        <div class="my-card p-4 mb-4 shadow-sm custom-mq mx-auto">
            <p class="fs-5 fw-bold mb-2">Descripción del problema</p>
            <p>{{ $order->problem_description }}</p>
            @php
                $statusTranslations = [
                    'pending' => 'Pendiente',
                    'paid' => 'Pagado',
                    'completed' => 'Completado',
                    'cancelled' => 'Cancelado',
                ];
            @endphp
            <p class="fs-5 fw-bold mb-2 mt-4">Fecha de la orden</p>
            <p> {{ $order->created_at->format('d/m/Y') }} </p>
            @php
                $badgeClass = match ($order->status) {
                    'pending' => 'warning',
                    'paid' => 'success',
                    'cancelled' => 'danger',
                    'completed' => 'primary',
                    default => 'dark',
                };
            @endphp
            <p class="fs-5 fw-bold mb-2 mt-4">Estado del pedido</p>
            <p class="fs-5">
                <span class="badge bg-{{ $badgeClass }}">
                    {{ $statusTranslations[$order->status] ?? $order->status }}
                </span>
            </p>

            <p class="fs-5 fw-bold mb-2 mt-4">Servicios contratados</p>
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
            <p class="fs-5 fw-bold mb-2">Total: <span class="fw-bold fs-5">${{ $order->total_price }}</span></p>
            <p class="mt-2 mb-4">Tiempo estimado: {{ $order->estimated_days }}
                {{ $order->estimated_days == 1 ? 'día hábil' : 'días hábiles' }}
            </p>
            <div class="d-flex justify-content-center gap-2 my-4">
                <a href="{{ route('client.profile') }}" class="btn btn-secondary">Ir a mi perfil</a>
                @if ($order->status === 'pending')
                    <a href="{{ route('orders.cancel.confirmation', $order) }}" class="btn-pink">Cancelar pedido</a>
                    <a href="{{ route('orders.pay', $order) }}" class="btn btn-info">Pagar con MercadoPago</a>
                @endif
            </div>
        </div>
    </div>
</x-layout>
