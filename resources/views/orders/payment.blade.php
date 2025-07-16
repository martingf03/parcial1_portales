<x-layout>
    <x-slot:title>Pago Orden #{{ $order->id }}</x-slot:title>
    <div class="container my-3">
        <h1 class="text-center">Procesar pago de Orden #{{ $order->id }}</h1>
        <div class="bg-light rounded p-4 my-4 shadow-sm custom-mq mx-auto">
            <p class="text-center text-blue-mp mb-2">Continuar a:</p>
            <div id="checkout" class="mx-auto w-100"></div>
        </div>
    </div>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('APP_USR-47acd465-c7ee-4b46-b084-04bdfdbf960e');

        mp.bricks().create(
            "wallet",
            "checkout", {
            initialization: {
                preferenceId: '{{ $preference_id }}',
            },
        });
    </script>
</x-layout>
