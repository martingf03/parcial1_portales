<x-layout>
    <x-slot:title>Pago exitoso</x-slot:title>
    <div class="container text-center mx-auto">
        <h1 class="text-center my-4">¡Gracias por tu pago!</h1>
        <div class="my-card custom-mq p-5 my-3 mx-auto">
            <div class="mx-auto d-flex justify-content-center mb-4">
                <img src="{{ secure_asset('img/success.png') }}" alt="Pago realizado" class="img-success">
                {{-- Para usarlo con Ngrok o Cloudflared, todos los métodos url los cambie por secure_asset, para forzar protocolo seguro https. --}}
                {{-- Para ejecutarlo desde localhost, debe usarse método url. --}}
                {{-- <img src="{{ url('img/success.png') }}" alt="Pago realizado" class="img-success"> --}}
            </div>
            <p class="text-center mb-2">La orden #{{ $order->id }} ha sido registrada como <span class="fw-bold">pagada</span>.</p>
            <a href="{{ route('orders.show', $order) }}" class="btn-pink mt-4">Ver mi pedido</a>
        </div>
    </div>
</x-layout>
