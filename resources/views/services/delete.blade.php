<?php
/** @var \App\Models\Service $service */
?>

<x-layout>
    <x-slot:title>Eliminar {{ $service->service_name }}</x-slot:title>
    <h1 class="my-3 text-center">Eliminar servicio</h1>
    <div class="container">
        <div class="custom-mq my-card p-4 mx-auto">
            <div class="mx-auto my-4 text-center">
                <p>Vas a <span class="fw-bold">eliminar</span> al siguiente servicio:
                <p class="fw-bold fs-5 pb-4 border-bottom-pink">{{ $service->service_name }}</p>
                <p>¿Querés proceder?</p>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-2">
                <a class="btn btn-secondary" href="{{ route('services') }}">No, volver</a>
                <form action="{{ route('services.destroy', ['id' => $service->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-pink">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
