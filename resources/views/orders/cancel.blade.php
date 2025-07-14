<?php
/** @var \App\Models\Order $order */
?>

<x-layout>
    <x-slot:title>Cancelar pedido #{{ $order->id }}</x-slot:title>
    <h1 class="my-3 text-center">Pedido #{{ $order->id }}</h1>
    <div class="container">
        <div class="custom-mq my-card p-4 mx-auto">
            <div class="mx-auto my-4 text-center">
                <p class="fw-bold fs-5 pb-4 border-bottom-pink">El pedido será dado de baja.</p>
                <p>¿Querés proceder?</p>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-2">
                <a class="btn btn-secondary" href="{{ route('orders.show', $order->id) }}">Volver</a>
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-pink">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
