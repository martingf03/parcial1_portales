<x-layout>
    <x-slot:title>Pago rechazado</x-slot:title>
    <div class="container text-center mx-auto">
        <h1 class="text-center my-4">Hubo un problema con tu pago</h1>
        <div class="my-card custom-mq p-5 my-3 mx-auto">
            <div class="mx-auto d-flex justify-content-center mb-4">
                <img src="{{ secure_asset('img/failure.png') }}" alt="Pago rechazado" class="img-success">
            </div>
            <p class="text-center mb-2">
                Lamentablemente, la orden #{{ $order->id }} no pudo ser procesada. <br>
                El pago fue <span class="fw-bold">rechazado</span> por MercadoPago.
            </p>
            <a href="{{ route('orders.pay', $order) }}" class="btn-pink mt-4">Intentar nuevamente</a>
        </div>
    </div>
</x-layout>
